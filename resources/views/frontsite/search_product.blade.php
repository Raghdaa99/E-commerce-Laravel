
@extends('frontsite.layout.master')
@section('content')
    <!--================Blog Area =================-->

    <section class="blog_area section-padding">
        <h4 style="text-align: center; margin-top: 15px">Search on {{$word}}</h4>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @if($products->count()>0)
                            @foreach($products as $product)
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" src="{{asset('product_images/'.$product->image)}}" alt="">
                                <a href="#" class="blog_item_date">

{{--                                    <p>{{$product->created_at}}</p>--}}
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="{{route('frontsite.details',$product->id)}}">
                                    <h2>{{$product->name}}</h2>
                                </a>
                                <p>{{substr($product->description, 0, 100)}}...</p>
                                <ul class="blog-info-link">
                                    <li><a href="#"><i class="fa fa-user"></i>{{$product->category->title}}</a></li>

{{--                                    <li><a href="#"><i class="fa fa-comments"></i> {{$post->comments->count()}} Comments</a></li>--}}
                                </ul>
                            </div>
                        </article>
                            @endforeach
                        @else
                            <h3> No results search</h3>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--================Blog Area =================-->
@endsection

@section('title')
    Search Page
@endsection
