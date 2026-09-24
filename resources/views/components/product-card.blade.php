<div class="col-6 col-md-4">
    <a href="{{ route('product.show', ['id' => $id]) }}" class="product-card-link">
        <div class="card h-100 product-card">
            <div class="product-img-wrap">
                <span class="ori-badge">Mall | ORI</span>
                <img src="{{ asset('images/' . $image) }}" alt="{{ $name }}" class="product-image">
            </div>
            <div class="card-body">
                <h6 class="card-title">{{ $name }}</h6>
                @isset($storeLocation)
                <p class="store-location"><i class="fa fa-location-dot"></i> {{ $storeLocation }}</p>
                @endisset
                <p class="card-text">Rp {{ number_format($price, 0, ',', '.') }}</p>
            </div>
        </div>
    </a>
</div>