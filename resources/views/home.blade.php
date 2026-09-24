<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAVIRA - Skincare Marketplace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @include('layout.navbar')

    <!-- Menu -->
    <div class="bg-primary text-white text-center py-2">
        <a href="#" class="text-white mx-3">HOME</a>
        <a href="#" class="text-white mx-3">ABOUT</a>
        <a href="#" class="text-white mx-3">REVIEW</a>
        <a href="#" class="text-white mx-3">CONTACT</a>
    </div>

    <!-- Hero Section -->
    <section class="container mt-3">
        <div class="hero-banner position-relative overflow-hidden">
            <div class="hero-blob hero-blob-1"></div>
            <div class="hero-blob hero-blob-2"></div>

            <div class="row align-items-center g-3 position-relative">
                <div class="col-md-7">
                    <span class="hero-badge mb-2">✨ 100% Original & Bergaransi</span>
                    <h1 class="hero-title mb-2">
                        Rawat Kulitmu dengan <span class="text-primary">Skincare Terpercaya</span>
                    </h1>
                    <p class="hero-subtitle mb-3">
                        Temukan produk original dari berbagai brand favorit hanya di <strong class="text-primary">LAVIRA</strong>.
                    </p>
                    <a href="#products" class="btn btn-primary rounded-pill px-4">Belanja Sekarang</a>
                </div>
                <div class="col-md-5 text-center px-4">
                    <img src="/images/shopping-bags.png" alt="" class="hero-image">
                </div>
            </div>
        </div>

        <!-- Trust badges -->
        <div class="row text-center trust-badges g-3 mt-1">
            <div class="col-4">
                <i class="fa fa-certificate trust-icon"></i>
                <p class="mb-0 fw-bold">100% Original</p>
                <small class="text-muted">Produk terjamin asli</small>
            </div>
            <div class="col-4">
                <i class="fa fa-truck-fast trust-icon"></i>
                <p class="mb-0 fw-bold">Pengiriman Cepat</p>
                <small class="text-muted">Sampai dengan aman</small>
            </div>
            <div class="col-4">
                <i class="fa fa-spa trust-icon"></i>
                <p class="mb-0 fw-bold">Kurasi Ahli</p>
                <small class="text-muted">Dipilih untuk kulitmu</small>
            </div>
        </div>
    </section>

    <!-- Products -->
    <section class="container py-2" id="products">
        <div class="row g-4">
            @foreach ($products->take(6) as $product)
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
    </section>

    <!-- About Section -->
    <section class="bg-dark text-white py-5">
        <div class="container">
            <h2 class="text-center mb-5">ABOUT US</h2>
            <div class="row gy-4">
                <div class="col-md-5">
                    <h5 class="mb-3"><span class="about-accent"></span>LAVIRA</h5>
                    <p class="text-white-50">LAVIRA adalah marketplace skincare terpercaya yang menghadirkan produk perawatan kulit original dari berbagai brand ternama. Kami berkomitmen menghadirkan produk yang aman, berkualitas, dan sesuai kebutuhan kulitmu.</p>
                </div>
                <div class="col-md-3">
                    <div class="stat-item mb-3">
                        <h4 class="text-primary mb-0">500+</h4>
                        <small class="text-white-50">Produk Skincare</small>
                    </div>
                    <div class="stat-item mb-3">
                        <h4 class="text-primary mb-0">50+</h4>
                        <small class="text-white-50">Brand Ternama</small>
                    </div>
                    <div class="stat-item">
                        <h4 class="text-primary mb-0">10K+</h4>
                        <small class="text-white-50">Pelanggan Puas</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5 class="mb-3">Layanan</h5>
                    <ul>
                        <li><i class="fa fa-chevron-right me-2 text-primary"></i>Bantuan</li>
                        <li><i class="fa fa-chevron-right me-2 text-primary"></i>Hubungi Kami</li>
                        <li><i class="fa fa-chevron-right me-2 text-primary"></i>Cara Berjualan</li>
                        <li><i class="fa fa-chevron-right me-2 text-primary"></i>Produk di Lavira</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

   <!-- Reviews -->
<section class="container py-5">
    <h2 class="text-center mb-4">CUSTOMER'S REVIEW</h2>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="p-4 bg-dark text-white rounded review-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('images/review-valerie.png') }}" alt="Valerie" class="review-avatar">
                        <strong>Valerie</strong>
                    </div>
                    <p class="mb-0">⭐⭐⭐⭐⭐</p>
                </div>
                <p class="mb-0">Produk original dan pengiriman cepat, kulit jadi lebih glowing sejak pakai skincare dari Lavira!</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-4 bg-dark text-white rounded review-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('images/review-arga.png') }}" alt="Arga" class="review-avatar">
                        <strong>Arga</strong>
                    </div>
                    <p class="mb-0">⭐⭐⭐⭐⭐</p>
                </div>
                <p class="mb-0">Pelayanan ramah, banyak pilihan brand skincare favorit. Recommended banget!</p>
            </div>
        </div>
    </div>
</section>

    <!-- Contact -->
    <section class="bg-dark text-white py-5">
        <div class="container">
            <h2 class="text-center mb-5">CONTACT</h2>
            <div class="row gy-4">
                <div class="col-md-6">
                    <h6 class="text-white-50 mb-2">Layanan Pengaduan Konsumen</h6>
                    <p class="fw-bold mb-2">LAVIRA</p>
                    <p class="mb-1">E-mail: customer@lavira.id</p>
                    <p class="mb-1">Instagram: @lavira.id</p>
                    <p class="mb-3">WhatsApp: +62 000 000 000</p>
                    <div class="d-flex gap-3 fs-5">
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fa fa-envelope"></i>
                        <i class="fa fa-phone"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6 class="mb-2">BERIKAN REVIEW UNTUK KAMI :</h6>
                    <p class="mb-3 fs-5">⭐ ⭐ ⭐ ⭐ ⭐</p>
                    <form>
                        <input class="form-control mb-3" type="text" placeholder="nama pengguna">
                        <textarea class="form-control mb-3" placeholder="masukan review anda!"></textarea>
                        <button class="btn btn-light px-4">send now!</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer class="text-center py-3 bg-light">
        <p>Create By LAVIRA</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>