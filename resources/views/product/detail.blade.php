@extends('layout.aa')

@section('content')
<div class="product-detail-page">

  @php
  $images = is_array($product->image) ? $product->image : [];
  $mainImage = $images[0] ?? 'default.png';
  @endphp

  <div class="detail-main">
    <div class="detail-gallery">
      <div class="main-image">
        <img id="mainProductImage" src="{{ asset('images/' . $mainImage) }}">
      </div>
    </div>

    <div class="product-info">
      <h1>{{ $product->name }}</h1>

      <div class="meta-row">
        <span class="category-label">{{ $product->category }}</span>
        @if($product->store_location)
        <span class="store-location"><i class="fa fa-location-dot"></i> {{ $product->store_location }}</span>
        @endif
      </div>

      <p class="description">{{ $product->description }}</p>

      <div class="price-box">
        <small class="text-muted d-block">Harga</small>
        <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
      </div>

      @guest
      <div class="action-row">
        <a href="{{ route('login') }}" class="btn-cart-outline">
          <i class="fa fa-cart-shopping"></i> Keranjang
        </a>
        <a href="{{ route('login') }}" class="btn-buy-solid">Beli Sekarang</a>
      </div>
      @else
      <div class="qty-row">
        <span>Kuantitas</span>
        <div class="qty-control">
          <button type="button" onclick="changeQty(-1)">-</button>
          <span id="qtyValue">1</span>
          <button type="button" onclick="changeQty(1)">+</button>
        </div>
      </div>

      <div class="action-row">
        <form method="POST" action="{{ route('cart.store', $product->id) }}" id="cartForm">
          @csrf
          <input type="hidden" name="quantity" id="qtyInput" value="1">
          <button type="submit" class="btn-cart-outline">
            <i class="fa fa-cart-shopping"></i> Keranjang
          </button>
        </form>
        <a href="{{ route('payment', $product->id) }}" class="btn-buy-solid">Beli Sekarang</a>
      </div>
      @endguest
    </div>
  </div>

  <!-- Produk Serupa di bawah -->
  @if ($relatedProducts->count())
  <div class="related-section">
    <h6 class="related-title">Mungkin kamu suka dengan jenis produk yang sama</h6>
    <div class="row g-4">
      @foreach ($relatedProducts as $item)
      @php
      $itemImages = is_string($item->image) ? json_decode($item->image, true) : $item->image;
      $itemMainImage = $itemImages[0] ?? 'default.png';
      @endphp
      <x-product-card
        :id="$item->id"
        :name="$item->name"
        :price="$item->price"
        :image="$itemMainImage"
        :storeLocation="$item->store_location" />
      @endforeach
    </div>
  </div>
  @endif

</div>

<script>
  let qty = 1;

  function changeQty(delta) {
    qty = Math.max(1, qty + delta);
    document.getElementById('qtyValue').innerText = qty;
    const qtyInput = document.getElementById('qtyInput');
    if (qtyInput) qtyInput.value = qty;
  }
</script>
@endsection