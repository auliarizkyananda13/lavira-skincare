@extends('layout.aa')

@section('content')
<div class="container py-4" style="max-width: 700px;">
    <h4 class="mb-4">Konfirmasi Pesanan</h4>

    <form method="POST" action="{{ route('cart.order.store') }}">
        @csrf

        <div class="border rounded p-3 mb-3">
            <label class="form-label small text-muted">Nama</label>
            <input type="text" class="form-control mb-3" value="{{ $user->name }}" readonly>

            <label class="form-label small text-muted">Email</label>
            <input type="email" class="form-control mb-3" value="{{ $user->email }}" readonly>

            <label class="form-label small text-muted">Alamat</label>
            <input type="text" name="location_description" class="form-control mb-3" value="{{ $user->location_description }}" required>

            <label class="form-label small text-muted">No. HP</label>
            <input type="text" name="phone_number" class="form-control" value="{{ $user->phone_number }}" required>
        </div>

        <div class="border rounded p-3 mb-3">
            @foreach ($cartItems as $item)
                @php
                    $images = json_decode($item->product->image, true);
                    $img = $images[0] ?? 'default.png';
                @endphp
                <div class="d-flex align-items-center justify-content-between border-bottom py-2">
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('images/' . $img) }}" style="width:50px;height:50px;object-fit:cover;border-radius:6px;">
                        <div>
                            <p class="mb-0" style="font-size:14px;">{{ $item->product->name }}</p>
                            <small class="text-muted">Qty: {{ $item->quantity }}</small>
                        </div>
                    </div>
                    <p class="mb-0 fw-bold">Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-between align-items-center border rounded p-3 mb-3">
            <span class="fw-bold">Total Bayar</span>
            <span class="fw-bold text-danger fs-5">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <div class="border rounded p-3 mb-3 bg-light text-center small text-muted">
            Metode Pembayaran akan diinformasikan lewat kontak anda.<br>
            Pastikan nomor dan alamat email aktif agar bisa dihubungi.<br>
            Tenang saja jika gambar tidak sesuai dengan yang anda pilih, kami akan melakukan konfirmasi kepada anda nantinya.
        </div>

        <button type="submit" class="btn btn-dark w-100 py-2">Simpan Pesanan</button>
    </form>
</div>
@endsection