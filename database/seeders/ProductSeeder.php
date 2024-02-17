<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Products::create([
            'product_name' => 'Onion',
            'no_of_quantity' => '50',
            'product_per_price' => 2,
        ]);

        Products::create([
            'product_name' => 'Carrot',
            'no_of_quantity' => '100',
            'product_per_price' => 4,
        ]);

        Products::create([
            'product_name' => 'Beetrot',
            'no_of_quantity' => '200',
            'product_per_price' => 5,
        ]);

        Products::create([
            'product_name' => 'lemon',
            'no_of_quantity' => '20',
            'product_per_price' => 5,
        ]);

        Products::create([
            'product_name' => 'beans',
            'no_of_quantity' => '500',
            'product_per_price' => 1,
        ]);
    }
}
