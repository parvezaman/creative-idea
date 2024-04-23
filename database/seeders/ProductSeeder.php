<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        product::create(
            [
                "name" => "product 1",
                "price" => 34.43,
                "description" => "arflkhaf aldkfa fnaldfha l",
            ]
        );
    }
}
