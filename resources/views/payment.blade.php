@extends('layout.payment-app')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-link me-2">←</a>
        <h4 class="mb-0 fw-bold">Payment</h4>
    </div>

    <div class="row">
        <!-- Contact Information -->
        <div class="col-md-6">
            <h5 class="fw-bold">Contact Information</h5>
            <form>
                <div class="mb-3">
                    <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" value="{{ $user->location_description ?? '' }}" disabled>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" value="{{ $user->phone_number ?? '' }}" disabled>
                </div>
            </form>
        </div>

        
        <!-- Order Summary -->
        <div class="col-md-6">
            <h5 class="fw-bold">Order Summary</h5>
            <div class="border p-3 rounded d-flex align-items-center">
                @php
                    $images = is_array($product->image) ? $product->image : json_decode($product->image, true);
                @endphp
                <img src="{{ asset('images/' . $images[0]) }}" alt="Product Image" class="me-3" style="width: 80px; height: 80px; object-fit: cover;">
                <div>
                    <strong>{{ $product->name }}</strong><br>
                    <span>1</span> <strong>Rp{{ number_format($product->price, 0, ',', '.') }}</strong>
                </div>
            </div>
            <div class="mt-2 text-end fw-bold">
                Total: Rp{{ number_format($product->price, 0, ',', '.') }}
            </div>
        </div>
    </div>

    <div class="info-box mt-4 p-3">
        Metode Pembayaran akan diinformasikan lewat kontak anda<br>
        Pastikan agar nomor dan alamat email aktif<br>
        agar bisa dihubungi<br>
        Tenang saja jika gambar tidak sesuai dengan yang anda pilih, kami akan melakukan konfirmasi kepada anda nantinya 
    </div>

    <div class="text-center mt-4">
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="total_price" value="{{ $product->price }}">
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5 py-2">Lanjutkan</button>
            </div>
        </form>
    </div>

</div>
@endsection
