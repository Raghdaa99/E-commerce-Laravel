<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    function __construct()
//    {
//         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
//         $this->middleware('permission:product-create', ['only' => ['create','store']]);
//         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
//         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands=Brand::all();
        $categories = Category::all();
        return view('products.create', compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->active = $request->active;
        $product_image = $request->file('img');
        $product_image2 = $request->file('img2');
        $product_image3 = $request->file('img3');
        $product_image4 = $request->file('img4');
        $file_name = $product->name .'1'. time() . '.' . $product_image->extension();
        $file_name2 = $product->name .'2'. time() . '.' . $product_image2->extension();
        $file_name3 = $product->name .'3'. time() . '.' . $product_image3->extension();
        $file_name4 = $product->name.'4' . time() . '.' . $product_image4->extension();
        $product_image->move('product_images', $file_name);
        $product_image2->move('product_images', $file_name2);
        $product_image3->move('product_images', $file_name3);
        $product_image4->move('product_images', $file_name4);
        $product->image = $file_name;
        $product->image2 = $file_name2;
        $product->image3 = $file_name3;
        $product->image4 = $file_name4;
        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate([
            'name' => 'required',

        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->price = $request->price;
        if ($request->file('img') != null) {
            $product_image = $request->file('img');
            $file_name = $product->title . time() . '.' . $product_image->extension();
            $product_image->move('product_images', $file_name);
            $product->image = $file_name;
        }

        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
