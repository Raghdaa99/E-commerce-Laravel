<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $id_user = Auth::user()->id;
//        if (Auth::user()) {
        $price = Product::find($id)->price;
        $already_cart = Cart::where('user_id', $id_user)->where('order_id', null)->where('product_id', $id)->first();
        if ($already_cart) {
            $already_cart->quantity = $already_cart->quantity + \request('quantity');
            $already_cart->amount = $price * $already_cart->quantity;
            $already_cart->save();
        } else {

            $cart = new Cart();
            $cart->product_id = $id;
            $cart->user_id = $id_user;
            $cart->price = $price;
            $cart->quantity = \request('quantity');
            $cart->amount = $price * \request('quantity');
            $cart->save();
        }


        return redirect()->route('frontsite.cart');
//        } else {

//            return redirect()->route('frontsite.details','id')
//                ->with('error', 'you must login or register before');
//        }

    }

    public function singleAddToCart($id)
    {
        $id_user = Auth::user()->id;
//        if (Auth::user()) {
        $product = Product::find($id);
        $price = $product->price;
        $already_cart = Cart::where('user_id', $id_user)->where('product_id', $id)->first();
        if ($already_cart) {
            $already_cart->quantity = $already_cart->quantity+1;
            $already_cart->amount = $price * $already_cart->quantity;
            $already_cart->save();

           // dd('done');
        } else {

            $cart = new Cart();
            $cart->product_id = $id;
            $cart->user_id = $id_user;
            $cart->price = $price;
            $cart->quantity = 1;
            $cart->amount = $price;
            $cart->save();
        }


        return redirect()->route('frontsite.shop', $product->category_id)->with('success', 'Product successfully added to cart.');
//        request()->session()->flash('success', 'Product successfully added to cart.');
//        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update(Request $request)
    {
        $id_cart = $request->cart_id;
        $cart = Cart::find($id_cart);
        $cart->quantity = $request->product_qty;
        $cart->amount = $cart->price * $cart->quantity;
        $cart->save();
        return redirect()->route('frontsite.cart');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cart $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
