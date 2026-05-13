<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 1500, 28000);
        $shipping = 250;

        return [
            'user_id' => User::factory(),
            'order_number' => 'ORD-' . fake()->date('Ymd') . '-' . Str::upper(fake()->bothify('??##??')),
            'subtotal' => $subtotal,
            'shipping_amount' => $shipping,
            'total_amount' => $subtotal + $shipping,
            'status' => fake()->randomElement(['pending', 'processing', 'shipped', 'delivered']),
            'payment_status' => 'cash_on_delivery',
            'shipping_address' => fake()->streetAddress(),
            'city' => fake()->randomElement(['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Peshawar', 'Multan']),
            'notes' => fake()->boolean(30) ? fake()->sentence() : null,
            'placed_at' => fake()->dateTimeBetween('-2 months', 'now'),
        ];
    }
}
