@extends('layout.minmin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 fw-bold text-center">Daftar Pesanan</h1>

    <div class="table-responsive">
        <table class="table table-hover align-middle table-bordered shadow-sm">
            <thead class="table-dark text-center">
                <tr>
                    <th>User</th>
                    <th>Produk</th>
                    <th>Lokasi</th>
                    <th>No Telepon</th>
                    <th>Harga</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td style="max-width: 300px;">{{ $order->location_description }}</td>
                        <td>{{ $order->phone_number }}</td>
                        <td><span class="badge bg-success">Rp{{ number_format($order->price, 0, ',', '.') }}</span></td>
                        <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada pesanan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
