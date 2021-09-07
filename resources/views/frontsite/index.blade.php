@extends('frontsite.layout.master')

@section('content')

    <div class="products-catagories-area clearfix">
        <div class="amado-pro-catagory clearfix">
        @foreach($products as $product)
            <!-- Single Catagory -->
                <div class="single-products-catagory clearfix">
                    <a href="{{route('frontsite.details',$product->id)}}">
                        <img src="{{asset('product_images/'.$product->image)}}" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From ${{ $product->price }}</p>
                            <h4>{{ $product->name }}</h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('title')
    Home
@endsection
