@extends('layout.aa')

@section('content')
<style>
    .cart-wrap { max-width: 1000px; margin: 0 auto; padding: 24px 16px 60px; }
    .cart-title { font-size: 20px; font-weight: 700; margin-bottom: 20px; }
    .cart-table-head {
        display: grid;
        grid-template-columns: 3fr 1fr 1.2fr 1fr 0.8fr;
        padding: 10px 14px;
        background: #fafafa;
        border-radius: 8px 8px 0 0;
        font-size: 13px;
        color: #888;
        border: 1px solid #eee;
        border-bottom: none;
    }
    .cart-item-row {
        display: grid;
        grid-template-columns: 3fr 1fr 1.2fr 1fr 0.8fr;
        align-items: center;
        padding: 14px;
        border: 1px solid #eee;
        border-top: none;
    }
    .cart-item-product { display: flex; align-items: center; gap: 12px; }
    .cart-item-product img { width: 56px; height: 56px; object-fit: cover; border-radius: 8px; background: #f7f7f7; }
    .cart-item-name { font-size: 14px; font-weight: 600; margin: 0; }
    .cart-item-price, .cart-item-subtotal { font-size: 14px; text-align: center; }
    .cart-item-subtotal { font-weight: 700; color: #d0021b; }
    .cart-qty-box { display: flex; align-items: center; justify-content: center; border: 1px solid #ddd; border-radius: 6px; width: fit-content; margin: 0 auto; }
    .cart-qty-box button { width: 26px; height: 26px; border: none; background: #f5f5f5; cursor: pointer; font-size: 14px; }
    .qty-display { display: inline-block; width: 34px; text-align: center; border-left: 1px solid #ddd; border-right: 1px solid #ddd; font-size: 14px; color: #111; background: #fff; font-weight: 700; }
    .cart-item-action { text-align: center; }
    .cart-item-action button { background: none; border: none; color: #d0021b; font-size: 13px; text-decoration: underline; cursor: pointer; }

    .cart-summary {
        margin-top: 20px;
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 16px 20px;
        max-width: 360px;
        margin-left: auto;
    }
    .cart-summary-line { display: flex; justify-content: space-between; font-size: 14px; color: #555; margin-bottom: 8px; }
    .cart-summary-line.total { font-weight: 700; font-size: 16px; color: #111; border-top: 1px solid #eee; padding-top: 10px; margin-top: 4px; }
    .cart-summary-line.total span:last-child { color: #d0021b; }
    .btn-cart-checkout {
        display: block;
        text-align: center;
        background: #111;
        color: #fff;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        margin-top: 14px;
    }

    @media (max-width: 700px) {
        .cart-table-head { display: none; }
        .cart-item-row { grid-template-columns: 1fr; gap: 8px; }
        .cart-item-price, .cart-item-subtotal, .cart-item-action { text-align: left; }
        .cart-qty-box { margin: 0; }
    }
</style>

<div class="cart-wrap">
    <h3 class="cart-title">Keranjang Saya</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($cartItems->isEmpty())
        <p>Keranjang kamu masih kosong.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Belanja Sekarang</a>
    @else
        <div class="cart-table-head">
            <span>Produk</span>
            <span style="text-align:center">Harga</span>
            <span style="text-align:center">Kuantitas</span>
            <span style="text-align:center">Subtotal</span>
            <span style="text-align:center">Aksi</span>
        </div>

        @foreach ($cartItems as $item)
            @php
                $images = json_decode($item->product->image, true);
                $img = $images[0] ?? 'default.png';
            @endphp
            <div class="cart-item-row">
                <div class="cart-item-product">
                    <img src="{{ asset('images/' . $img) }}" alt="{{ $item->product->name }}">
                    <p class="cart-item-name">{{ $item->product->name }}</p>
                </div>

                <div class="cart-item-price">Rp {{ number_format($item->product->price, 0, ',', '.') }}</div>

                <div>
                    <form method="POST" action="{{ route('cart.update', $item->id) }}" class="qty-form">
                        @csrf
                        @method('PATCH')
                        <div class="cart-qty-box">
                            <button type="button" onclick="stepQty(this, -1)">-</button>
                            <span class="qty-display">{{ $item->quantity }}</span>
                            <input type="hidden" name="quantity" value="{{ $item->quantity }}">
                            <button type="button" onclick="stepQty(this, 1)">+</button>
                        </div>
                    </form>
                </div>

                <div class="cart-item-subtotal">Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}</div>

                <div class="cart-item-action">
                    <form method="POST" action="{{ route('cart.destroy', $item->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach

        @php
            $totalItem = $cartItems->sum('quantity');
        @endphp

        <div class="cart-summary">
            <div class="cart-summary-line">
                <span>Total Produk</span>
                <span>{{ $totalItem }} item</span>
            </div>
            <div class="cart-summary-line total">
                <span>Total Bayar</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <a href="{{ route('cart.checkout') }}" class="btn-cart-checkout">Lanjut ke Pembayaran</a>
        </div>
    @endif
</div>

<script>
function stepQty(btn, delta) {
    const form = btn.closest('.qty-form');
    const display = form.querySelector('.qty-display');
    const input = form.querySelector('input[name="quantity"]');
    let val = Math.max(1, parseInt(display.innerText) + delta);
    display.innerText = val;
    input.value = val;
    form.submit();
}
</script>
@endsection