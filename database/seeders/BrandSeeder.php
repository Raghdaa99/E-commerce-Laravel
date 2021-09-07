<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = [
            [
                'title' => 'Amado',
                'status' => 'active',

            ],
            [
                'title' => 'Ikea',
                'status' => 'active',
            ],
            [
                'title' => 'Furniture Inc',
                'status' => 'active',
            ],
            [
                'title' => 'The factory',
                'status' => 'active',
            ],
            [
                'title' => 'Artdeco',
                'status' => 'active',
            ],
        ];

        foreach ($brand as $key => $value) {
            Brand::create($value);
        }
    }
}
