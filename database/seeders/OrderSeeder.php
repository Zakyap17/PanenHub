<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $buyer = User::where('role', 'pembeli')->first();
        $mitra = User::where('role', 'mitra')->first();
        
        if ($buyer && $mitra) {
            $products = Product::all();
            
            // Seed a few orders with different quantities to demonstrate the realtime sold count
            $sales = [
                0 => 35, // 35 sold for Pandan Wangi
                1 => 2,  // 2 sold for IR 64
                2 => 18, // 18 sold for Putih Cianjur
                3 => 42, // 42 sold for Ramos Sentra
                4 => 8,  // 8 sold for Medium IR III
                5 => 0,  // 0 sold for Merah Organik (no order)
                6 => 15, // 15 sold for Ketan Putih
                7 => 5,  // 5 sold for Jagung Lokal
            ];
            
            foreach ($sales as $index => $qty) {
                if ($qty > 0 && isset($products[$index])) {
                    $product = $products[$index];
                    
                    $order = Order::create([
                        'order_number' => 'PH-SEED' . $index . strtoupper(uniqid()),
                        'buyer_id' => $buyer->id,
                        'mitra_id' => $mitra->id,
                        'total_price' => $product->price * $qty,
                        'status' => 'selesai',
                        'payment_method' => 'Transfer Bank',
                        'address' => 'Desa Parungserab, Bandung',
                    ]);
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_image' => $product->image,
                        'price' => $product->price,
                        'quantity' => $qty,
                    ]);
                }
            }
        }
    }
}
