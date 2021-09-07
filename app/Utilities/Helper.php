<?php
namespace App\Utilities;
use App\Models\Product;

class Helper
{
    public static function minPrice(){
        return floor(Product::min('price'));
    }
    public static function maxPrice(){
        return floor(Product::max('price'));
    }
}
