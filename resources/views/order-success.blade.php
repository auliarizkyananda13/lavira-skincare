@extends('layout.aa')

@section('content')
<div class="container py-5" style="max-width: 600px;">
    <div class="text-center mb-4">
        <div style="font-size: 60px;">✅</div>
        <h3 class="fw-bold mt-3 mb-2">Pesanan Berhasil Diproses</h3>
        <p class="text-muted">
            Kami akan menghubungi Anda melalui WhatsApp atau email yang Anda berikan untuk konfirmasi alamat dan pembayaran.
        </p>
    </div>

    @if (session('ordered_items'))
        <div class="border rounded p-3 mb-3">
            <h6 class="mb-3">Produk yang Dipesan</h6>
            @foreach (session('ordered_items') as $item)
                <div class="d-flex align-items-center justify-content-between border-bottom py-2">
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('images/' . $item['image']) }}" style="width:50px;height:50px;object-fit:cover;border-radius:6px;">
                        <div>
                            <p class="mb-0" style="font-size:14px;">{{ $item['name'] }}</p>
                            <small class="text-muted">Qty: {{ $item['quantity'] }}</small>
                        </div>
                    </div>
                    <p class="mb-0 fw-bold">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                </div>
            @endforeach

            <div class="d-flex justify-content-between align-items-center pt-3">
                <span class="fw-bold">Total</span>
                <span class="fw-bold text-danger fs-5">Rp {{ number_format(session('ordered_total'), 0, ',', '.') }}</span>
            </div>
        </div>
    @endif

    <a href="{{ route('home') }}" class="btn btn-dark w-100 py-2">Kembali ke Beranda</a>
</div>
@endsection