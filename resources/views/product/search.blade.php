@extends('layout.aa')

@section('content')
<div class="container py-4">
    <h5 class="mb-4">Hasil pencarian untuk "{{ $query }}"</h5>

    @if ($products->isEmpty())
        <p>Produk tidak ditemukan.</p>
    @else
        <div class="row g-4">
            @foreach ($products as $product)
                @php
                    $images = json_decode($product->image, true);
                    $mainImage = $images[0] ?? 'default.png';
                @endphp
                <x-product-card
                    :id="$product->id"
                    :name="$product->name"
                    :price="$product->price"
                    :image="$mainImage"
                    :storeLocation="$product->store_location"
                />
            @endforeach
        </div>
    @endif
</div>
@endsection