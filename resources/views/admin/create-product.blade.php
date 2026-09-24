@extends('layout.minmin')

@section('content')
<div class="container">
    <h2>Tambah Produk</h2>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Nama Produk</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label for="description">Deskripsi</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group mt-2">
            <label for="price">Harga</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label for="image">Gambar Produk (lebih dari satu)</label>
            <input type="file" name="image[]"multiple required class="form-control" multiple required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Produk</button>
    </form>
</div>
@endsection
