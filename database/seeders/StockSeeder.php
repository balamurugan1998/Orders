<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Stock;
use App\Models\Products;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Products::withoutTrashed()->get();
        foreach($products as $product){
            Stock::create([
                'stock_name' => $product->product_name,
                'no_of_produts' => 50,
                'product_id' => $product->id,
            ]);
        }
    }
}
