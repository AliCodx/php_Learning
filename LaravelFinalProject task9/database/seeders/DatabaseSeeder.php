<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@bazaarcraft.pk'],
            [
                'name' => 'Ali Raza',
                'phone' => '03001234567',
                'address' => 'Main Boulevard, Gulberg',
                'city' => 'Lahore',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $customers = User::factory(14)->create();

        $catalog = [
            'Women Fashion' => ['Embroidered Lawn Suit', 'Printed Khaddar Set', 'Pearl Festive Kurti', 'Pastel Chiffon Dupatta'],
            'Men Fashion' => ['Classic Kurta Shalwar', 'Leather Wallet', 'Formal Waistcoat', 'Premium Peshawari Chappal'],
            'Home Decor' => ['Velvet Cushion Cover', 'Handwoven Storage Basket', 'Marble Serving Tray', 'Scented Candle Set'],
            'Beauty Essentials' => ['Rose Glow Serum', 'Vitamin C Face Wash', 'Silk Hair Mask', 'Matte Lip Kit'],
            'Kitchen Picks' => ['Ceramic Tea Set', 'Wooden Spice Rack', 'Gold Rim Dinner Plate', 'Nonstick Fry Pan'],
            'Mobile Accessories' => ['Fast Charge Power Bank', 'Braided Type-C Cable', 'Magnetic Phone Stand', 'Wireless Earbuds Case'],
        ];
        $productArtwork = [
            'Embroidered Lawn Suit' => 'https://images.pexels.com/photos/34251604/pexels-photo-34251604.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Printed Khaddar Set' => 'https://images.pexels.com/photos/28512776/pexels-photo-28512776.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Pearl Festive Kurti' => 'https://images.pexels.com/photos/28512776/pexels-photo-28512776.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Pastel Chiffon Dupatta' => 'https://images.pexels.com/photos/34251604/pexels-photo-34251604.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Classic Kurta Shalwar' => 'https://images.pexels.com/photos/8621978/pexels-photo-8621978.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Leather Wallet' => 'https://images.pexels.com/photos/27467357/pexels-photo-27467357.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Formal Waistcoat' => 'https://images.pexels.com/photos/18327458/pexels-photo-18327458.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Premium Peshawari Chappal' => 'https://images.pexels.com/photos/8621978/pexels-photo-8621978.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Velvet Cushion Cover' => 'https://images.pexels.com/photos/30554293/pexels-photo-30554293.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Handwoven Storage Basket' => 'https://images.pexels.com/photos/34667258/pexels-photo-34667258.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Marble Serving Tray' => 'https://images.pexels.com/photos/4108286/pexels-photo-4108286.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Scented Candle Set' => 'https://images.pexels.com/photos/10789371/pexels-photo-10789371.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Rose Glow Serum' => 'https://images.pexels.com/photos/13946076/pexels-photo-13946076.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Vitamin C Face Wash' => 'https://images.pexels.com/photos/13946076/pexels-photo-13946076.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Silk Hair Mask' => 'https://images.pexels.com/photos/10825668/pexels-photo-10825668.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Matte Lip Kit' => 'https://images.pexels.com/photos/14444882/pexels-photo-14444882.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Ceramic Tea Set' => 'https://images.pexels.com/photos/18426667/pexels-photo-18426667.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Wooden Spice Rack' => 'https://images.pexels.com/photos/458796/pexels-photo-458796.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Gold Rim Dinner Plate' => 'https://images.pexels.com/photos/18426654/pexels-photo-18426654.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Nonstick Fry Pan' => 'https://images.pexels.com/photos/4543005/pexels-photo-4543005.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Fast Charge Power Bank' => 'https://images.pexels.com/photos/11031423/pexels-photo-11031423.png?auto=compress&cs=tinysrgb&w=900',
            'Braided Type-C Cable' => 'https://images.pexels.com/photos/3921695/pexels-photo-3921695.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Magnetic Phone Stand' => 'https://images.pexels.com/photos/15255845/pexels-photo-15255845.jpeg?auto=compress&cs=tinysrgb&w=900',
            'Wireless Earbuds Case' => 'https://images.pexels.com/photos/3585797/pexels-photo-3585797.jpeg?auto=compress&cs=tinysrgb&w=900',
        ];

        $products = collect();

        foreach ($catalog as $categoryName => $items) {
            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'description' => fake()->sentence(14),
                'is_active' => true,
            ]);

            foreach ($items as $index => $item) {
                $products->push(Product::create([
                    'category_id' => $category->id,
                    'name' => $item,
                    'slug' => Str::slug($item) . '-' . Str::lower(Str::random(4)),
                    'sku' => 'PK-' . Str::upper(Str::random(8)),
                    'description' => fake()->paragraph(),
                    'price' => fake()->randomFloat(2, 1250, 18500),
                    'stock' => fake()->numberBetween(15, 90),
                    'image_url' => $productArtwork[$item],
                    'is_featured' => $index < 2,
                    'is_active' => true,
                ]));
            }
        }

        foreach ($customers as $customer) {
            $orderCount = rand(1, 3);

            for ($i = 0; $i < $orderCount; $i++) {
                $selectedProducts = $products->random(rand(1, 3));
                $selectedProducts = $selectedProducts instanceof Product ? collect([$selectedProducts]) : $selectedProducts;
                $subtotal = 0;

                $order = Order::create([
                    'user_id' => $customer->id,
                    'order_number' => 'ORD-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6)),
                    'subtotal' => 0,
                    'shipping_amount' => 250,
                    'total_amount' => 0,
                    'status' => collect(['pending', 'processing', 'shipped', 'delivered'])->random(),
                    'payment_status' => 'cash_on_delivery',
                    'shipping_address' => $customer->address,
                    'city' => $customer->city,
                    'notes' => fake()->boolean(35) ? fake()->sentence() : null,
                    'placed_at' => fake()->dateTimeBetween('-3 months', 'now'),
                ]);

                foreach ($selectedProducts as $product) {
                    $quantity = rand(1, 3);
                    $lineTotal = $product->price * $quantity;
                    $subtotal += $lineTotal;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'quantity' => $quantity,
                        'unit_price' => $product->price,
                        'line_total' => $lineTotal,
                    ]);
                }

                $order->update([
                    'subtotal' => $subtotal,
                    'total_amount' => $subtotal + $order->shipping_amount,
                ]);
            }
        }

        $messageUsers = $customers->random(6);
        foreach ($messageUsers as $user) {
            ContactMessage::create([
                'user_id' => $user->id,
                'subject' => collect([
                    'Need delivery update',
                    'Product exchange inquiry',
                    'Can you restock this item?',
                    'Order confirmation help',
                ])->random(),
                'message' => fake()->paragraph(),
            ]);
        }
    }
}
