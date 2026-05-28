<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $mitra = User::where('role', 'mitra')->first();

        if ($mitra) {
            Product::create([
                'user_id' => $mitra->id,
                'name' => 'Beras Premium Pandan Wangi',
                'category' => 'Beras',
                'price' => 18500,
                'stock' => 800,
                'image' => 'products/beras-pandan-wangi.jpg' 
            ]);

            Product::create([
                'user_id' => $mitra->id,
                'name' => 'Beras Premium IR 64',
                'category' => 'Beras',
                'price' => 15500,
                'stock' => 1200,
                'image' => 'products/beras-ir64.jpg' 
            ]);

            Product::create([
                'user_id' => $mitra->id,
                'name' => 'Beras Putih Cianjur',
                'category' => 'Beras',
                'price' => 16000,
                'stock' => 600,
                'image' => 'products/beras-putih.jpg'
            ]);

            Product::create([
                'user_id' => $mitra->id,
                'name' => 'Beras Ramos Sentra',
                'category' => 'Beras',
                'price' => 14700,
                'stock' => 950,
                'image' => 'products/beras-ramos.jpg'
            ]);

            Product::create([
                'user_id' => $mitra->id,
                'name' => 'Beras Medium IR III',
                'category' => 'Beras',
                'price' => 13900,
                'stock' => 450,
                'image' => 'products/beras-medium.jpg'
            ]);

            Product::create([
                'user_id' => $mitra->id,
                'name' => 'Beras Merah Organik',
                'category' => 'Beras',
                'price' => 22000,
                'stock' => 350,
                'image' => 'products/beras-merah.jpg'
            ]);

            Product::create([
                'user_id' => $mitra->id,
                'name' => 'Beras Ketan Putih',
                'category' => 'Beras',
                'price' => 17500,
                'stock' => 500,
                'image' => 'products/beras-ketan.jpg'
            ]);

            Product::create([
                'user_id' => $mitra->id,
                'name' => 'Beras Jagung Lokal',
                'category' => 'Beras',
                'price' => 12000,
                'stock' => 300,
                'image' => 'products/beras-jagung.jpg'
            ]);
        }
    }
}