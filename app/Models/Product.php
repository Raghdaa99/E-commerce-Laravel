<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description','active', 'price', 'image','image2','image3','image4'
    ];
    /**
     * @var mixed|string
     */


    public  function category(){
        return $this->belongsTo(Category::class);
    }
    public  function brand(){
        return $this->belongsTo(Brand::class);
    }
    public  function order(){
        return $this->belongsTo(Order::class);
    }
    public  function user(){
        return $this->belongsTo(User::class);
    }
    public function carts(){
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }
}
