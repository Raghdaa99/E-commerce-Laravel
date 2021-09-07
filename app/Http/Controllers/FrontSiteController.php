<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontSiteController extends Controller
{
    public function showHome()
    {
        $count = Cart::all()->count();
        $products = Product::orderBy('created_at', 'desc')->where('active', 'Yes')->take(9)->get();
        return view('frontsite.index', compact('products'))->with('count', $count);
    }

    public function showDetails($id)
    {
        $product = Product::find($id);

        return view('frontsite.product-details', compact('product'));
    }

    public function showShop(Request $request, $id)
    {
        $data = $request->all();
//        $category = Category::find($id);
//        $products = Product::where('category_id', $id)->paginate(4);
        $products = Product::query();
        $categories = Category::all();
        $route = 'shop';
        $sort = '';
        if ($request->sort != null) {
            $sort = $request->sort;
            if ($sort == 'priceAsc') {
                $products = $products->orderBy('price', 'ASC')->where('category_id', $id);

            } elseif ($sort == 'priceDes') {
                $products = $products->orderBy('price', 'DESC')->where('category_id', $id);
            } elseif ($sort == 'titleAsc') {
                $products = $products->orderBy('name', 'ASC')->where('category_id', $id);
            } elseif ($sort == 'titleDes') {
                $products = $products->orderBy('name', 'DESC')->where('category_id', $id);
            } elseif ($sort == 'newest') {
                $products = $products->orderBy('created_at', 'DESC')->where('category_id', $id);
            }
        }
        if (!empty($_GET['brand'])) {
            $idsBrand = explode(',', $_GET['brand']);
//            return $idsBrand;
            $brand_ids = Brand::select('id')->whereIn('id', $idsBrand)->pluck('id')->toArray();
            // dd($brand_ids);
//            $products = Product::where('category_id', $id)->whereIn('brand_id', $brand_ids)->paginate(4);
            $products = $products->whereIn('brand_id', $brand_ids);
//            dd($products);
        }
        if (!empty($_GET['price'])) {
            $price = explode('-', $_GET['price']);
            $price[0] = floor($price[0]);
            $price[1] = ceil($price[1]);
//            $products->whereBetween('price', $price);
            $products = $products->whereBetween('price', $price);
            // dd($price);
        }
        $products = $products->where('category_id', $id)->paginate(4);
        $brands = Brand::all();
//        dd($products);
        return view('frontsite.shop', compact('products', 'categories', 'route', 'id', 'brands'));
    }

    public function showCart()
    {
        $id_user = Auth::user()->id;

        $carts = Cart::orderBy('created_at', 'desc')->where('user_id', $id_user)->get();
        $total = Cart::orderBy('created_at', 'desc')->where('user_id', $id_user)->sum('amount');

        return view('frontsite.cart', compact('carts', 'total'));
    }

    public function checkout()
    {
        $user = Auth::user();
        return view('frontsite.checkout', compact('user'));
    }

    public function search(Request $request)
    {
        $word = $request->search;
        $products = Product::where('name', 'like', '%' . $word . '%')
            ->orWhere('description', 'like', '%' . $word . '%')->get();
        //$posts->description=substr($posts->description, 0, 50).'...';
        return view('frontsite.search_product', compact('products', 'word'));
    }

    public function filter(Request $request, $id)
    {
        $data = $request->all();
//        $products = [];
//        $newRequest = \Illuminate\Http\Request::capture();
//        $newRequest->replace($request->except(['_token']));
        $brandUrl = '';
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandUrl)) {
                    $brandUrl .= '?brand=' . $brand;
                } else {
                    $brandUrl .= ',' . $brand;
                }
            }
        }
//        dd($brandUrl);
        $price_range_url = "";
        if (!empty($data['price_range'])) {
            $price_range_url .= '?price=' . $data['price_range'];
        }

        //dd($price_range_url);

        // dd($newRequest->all());
        return redirect()->route('frontsite.shop', $id . $brandUrl . $price_range_url);
    }
}
