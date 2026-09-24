<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::truncate(); // Hapus semua data lama

        Product::create([
            'name' => 'Nike Kyrie',
            'price' => 2500000,
            'image' => json_encode(['nike-kyrie.png', 'kyrie-white.png', 'kyrie-black.png', 'kyrie-pink.png']),
            'description' => 'Kelebihan Nike Kyrie yaitu: Model sepatu sporty sekaligus stylish. Karena sepatu ini merupakan kolaborasi sekaligus sponsor untuk Kyrie Irving pemain basket pro, maka desain sepatunya sangat cocok untuk olahraga',
        ]);

        Product::create([
            'name' => 'Nike Backpack',
            'price' => 559000,
            'image' => json_encode(['nike-backpack.png', 'backpack-black.png', 'backpack-gray.png']),
            'description' => 'Kelebihan Nike Backpack yaitu desain yang simpel, sporty, sekaligus stylish. Tas ini dirancang untuk menemani aktivitas sehari-hari, mulai dari sekolah, kerja, hingga olahraga. Dengan ruang penyimpanan yang luas dan bahan tahan air, tas ini sangat cocok untuk kamu yang aktif dan tetap ingin tampil keren dalam segala situasi',
        ]);

        Product::create([
            'name' => 'Beads',
            'price' => 5000,
            'image' => json_encode(['beads.png', 'beads-bw.png', 'love-beads.png', 'star-beads.png']),
            'description' => 'Cincin manik-manik handmade ini adalah aksesori simpel namun unik yang dirancang untuk kamu yang suka tampil beda. Dibuat secara manual dengan detail warna yang ceria, cincin ini ringan, nyaman dipakai seharian, dan tahan lama berkat bahan berkualitas. Cocok untuk mix and match gaya kasual hingga playful, cincin ini jadi pilihan tepat untuk pelengkap outfit harian, hadiah spesial, atau sekadar ekspresi diri yang penuh warna - semua itu dengan harga yang tetap bersahabat.',
        ]);

        Product::create([
            'name' => 'Tarcktop',
            'price' => 800000,
            'image' => json_encode(['tarcktop.png', 'tracktop-blue.png', 'tracktop-blue2.png', 'tracktop-white.png']),
            'description' => 'Jaket ringan dengan desain sporty yang nyaman dipakai sehari-hari. Cocok untuk gaya santai atau aktivitas ringan. Bahan adem, cepat kering, dan mudah dipadukan dengan outfit apa saja.',
        ]);

        
        Product::create([
            'name' => 'Classic Cap',
            'price' => 275000,
            'image' => json_encode(['classic-cap.png', 'cap-black.png', 'cap-blue.png', 'cap-gray.png']),
            'description' => 'Tampil sporty dan stylish dengan Adidas Classic Baseball Cap. Terbuat dari bahan berkualitas tinggi yang nyaman dipakai seharian, cocok untuk pria dan wanita.',
        ]);
        // Tambahkan produk lain di sini
    }
}
