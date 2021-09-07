<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'title'=>'Chairs',
                'description'=>'Chairs',

            ],
            [
                'title'=>'Beds',
                'description'=>'Beds',
            ],
            [
                'title'=>'Furniture',
                'description'=>'Furniture',
            ],
            [
                'title'=>'Home Deco',
                'description'=>'Home Deco',
            ],
        ];

        foreach ($category as $key => $value) {
            Category::create($value);
        }
    }
}
