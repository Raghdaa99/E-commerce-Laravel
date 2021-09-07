<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shipping = [
            [
                'shippings_address'=>'Flat Rate',
                'delivery_time'=>'1-2 Business Day',
                'delivery_charge'=>'99.4',
                'status'=> 'active',
            ],
            [
                'shippings_address'=>'Free Shipping',
                'delivery_time'=>'1 Week',
                'delivery_charge'=>'3.00',
                'status'=> 'active',
            ],
        ];

        foreach ($shipping as $key => $value) {
            Shipping::create($value);
        }
    }
}
