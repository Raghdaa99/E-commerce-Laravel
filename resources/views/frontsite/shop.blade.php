@extends('frontsite.layout.master')

@section('content')

    <div class="shop_sidebar_area">

        <!-- ##### Single Widget ##### -->
        <div class="widget catagory mb-50">
            <!-- Widget Title -->
            <h6 class="widget-title mb-30">Catagories</h6>

            <!--  Catagories  -->
            <div class="catagories-menu">
                <ul>
                    @foreach($categories as $category1)
                        <li class="{{$id==$category1->id?'active' : ' '}}"><a
                                href="{{route('frontsite.shop',$category1->id)}}">{{$category1->title}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- ##### Single Widget ##### -->
        <form action="{{ route('product.filter',$id) }}" method="POST">
            @csrf
            <div class="widget brands mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Brands</h6>

                <div class="widget-desc">
                    <!-- Single Form Check -->
                    @if(!empty($_GET['brand']))
                        @php
                            $filter_brand = explode(',', $_GET['brand']);
                        @endphp
                    @endif
                    @foreach($brands as $brand)
                        <div class="form-check">
                            <input class="form-check-input" name="brand[]" onchange="this.form.submit();"
                                   type="checkbox" @if(!empty($filter_brand) && in_array($brand->id,$filter_brand)) checked @endif value="{{$brand->id}}" id={{$brand->id}}>
                            <label class="form-check-label" for="{{$brand->id}}">{{$brand->title}}</label>
                        </div>

                    @endforeach
                </div>
            </div>


            <!-- ##### Single Widget ##### -->
            <div class="widget price mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Price</h6>

                <div class="widget-desc">
                    <div class="slider-range">
                        <div id="slider-range" data-min="{{App\Utilities\Helper::minPrice()}}"
                             data-max="{{App\Utilities\Helper::maxPrice()}}" data-unit="$"
                             class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                             data-value-min="{{App\Utilities\Helper::minPrice()}}"
                             data-value-max="{{App\Utilities\Helper::maxPrice()}}" data-label-result="">
                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                            <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        </div>
                        <br>

                        {{--                    <div class="d-flex mt-4">--}}
                        @if(!empty($_GET['price']))
                            @php
                                $price = explode('-', $_GET['price']);
                            @endphp
                        @endif
                        <input id="price_range" type="hidden"
                               value="@if(!empty($_GET['price'])) {{$_GET['price']}} @endif"
                               name="price_range">
                        <input style="border: 0;width:100% " type="text" readonly id="amount"
                               value="@if(!empty($_GET['price'])) ${{$price[0]}} @else ${{App\Utilities\Helper::minPrice()}}@endif - @if(!empty($_GET['price'])) ${{$price[1]}} @else ${{App\Utilities\Helper::maxPrice()}}@endif">
                        {{--                    <div class="range-price">{{App\Utilities\Helper::minPrice()}}--}}
                        {{--                        - {{App\Utilities\Helper::maxPrice()}}</div>--}}
                        <button type="submit" class="btn btn-sm btn-primary float-right"
                                style="margin: 12px 0 12px 0px;height: 30px;">Filter Price
                        </button>
                        {{--                    </div>--}}
                    </div>
                </div>
            </div>
            {{--            <button type="submit" class="btn amado-btn mb-15">Filter</button>--}}
        </form>
    </div>

    <div class="amado_product_area section-padding-100">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                        <!-- Total Products -->
                        <div class="total-products">
                            <p>Showing 1-8 0f 25</p>
                            <div class="view d-flex">
                                <a href="#"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <!-- Sorting -->
                        <div class="product-sorting d-flex">
                            <div class="sort-by-date d-flex align-items-center mr-15">
                                <p style="padding-right: 10px">Sort by</p>
                                <form action="#" method="get">
                                    <select name="select" id="sortBydate">
                                        <option>Default Sort</option>
                                        <option value="priceAsc"
                                                @if(!empty($_GET['sort']) && $_GET['sort']=='priceAsc') selected @endif >
                                            Price - Lower To Higher
                                        </option>
                                        <option value="priceDes"
                                                @if(!empty($_GET['sort']) && $_GET['sort']=='priceDes') selected @endif >
                                            Price - Higher To Lower
                                        </option>
                                        <option value="titleAsc"
                                                @if(!empty($_GET['sort']) && $_GET['sort']=='titleAsc') selected @endif >
                                            Alphabetical Ascending
                                        </option>
                                        <option value="titleDes"
                                                @if(!empty($_GET['sort']) && $_GET['sort']=='titleDes') selected @endif >
                                            Alphabetical Descending
                                        </option>
                                        <option value="newest"
                                                @if(!empty($_GET['sort']) && $_GET['sort']=='newest') selected @endif >
                                            Newest
                                        </option>
                                    </select>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @include('frontsite.layout.message')

            <div class="row">

            @foreach($products as $product)

                <!-- Single Product Area -->
                    <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="{{asset('product_images/'.$product->image)}}" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="{{asset('product_images/'.$product->image2)}}"
                                     alt="">
                            </div>

                            <!-- Product Description -->
                            <div class="product-description d-flex align-items-center justify-content-between">
                                <!-- Product Meta Data -->
                                <div class="product-meta-data">
                                    <div class="line"></div>
                                    <p class="product-price">${{$product->price}}</p>
                                    <a href="{{route('frontsite.details',$product->id)}}">
                                        <h6>{{$product->name}}</h6>
                                    </a>
                                </div>
                                <!-- Ratings & Cart -->
                                <div class="ratings-cart text-right">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <div class="cart">
                                        <form class="cart clearfix" method="post"
                                              action="/carts/{{$product->id}}/singleAddToCart">
                                            @csrf
                                            {{--                                        <a href="" data-quantity="1" data-product-id="{{$product->id}}"--}}
                                            {{--                                           class="add_to_cart" id="add_to_cart{{$product->id}}" data-toggle="tooltip"--}}
                                            {{--                                           data-placement="left"--}}
                                            {{--                                           title="Add to Cart"><img src="{{asset('img/core-img/cart.png')}}" alt=""></a>--}}
                                            <button data-toggle="tooltip" data-placement="left" title="Add to Cart">
                                                <img src="{{asset('img/core-img/cart.png')}}" alt="">
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
{{--                    {{$products->appends($_GET)->links()}}--}}
                    {{$products->links()}}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Home
@endsection

@section('scripts')
    {{--  Price Slider  --}}
    <script>
        $(document).ready(function () {
            if ($('#slider-range').length > 0) {
                const max_price = parseInt($('#slider-range').data('max'));
                const min_price = parseInt($('#slider-range').data('min'));
                // const currency = $("#slider-range").data('currency') || '';
                let price_range = min_price + '-' + max_price;
                // alert(price_range)
                if ($("#price_range").length > 0 && $("#price_range").val()) {
                    price_range = $("#price_range").val().trim();
                }

                let price = price_range.split('-');
                $("#slider-range").slider({
                    range: true,
                    min: min_price,
                    max: max_price,
                    values: price,
                    slide: function (event, ui) {
                        $("#amount").val('$' + ui.values[0] + " -  " + '$' + ui.values[1]);
                        $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                    }
                });
            }
            // if ($("#amount").length > 0) {
            //     // const m_currency = $("#slider-range").data('currency') || '';
            //     $("#amount").val('$' + $("#slider-range").slider("values", 0) +
            //         "  -  " + '$' + $("#slider-range").slider("values", 1));
            // }


        });
    </script>
    {{--    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
    <script>
        $('#sortBydate').change(function () {
            var sort = $('#sortBydate').val();
            window.location = "{{url(''.$route.'')}}/{{$id}}?sort=" + sort;
        });
    </script>
    {{--    <script>--}}
    {{--        $(document).on('click', '.add_to_cart', function (e) {--}}
    {{--            e.preventDefault();--}}
    {{--            var quantity = $(this).data('quantity');--}}
    {{--            var pro_id = $(this).data('product-id');--}}
    {{--            // alert(quantity);--}}

    {{--            $.ajax({--}}
    {{--                url: "{{route('cart.store')}}",--}}
    {{--                type: "POST",--}}
    {{--                dataType: "JSON",--}}
    {{--                data: {--}}
    {{--                    _token: "{{csrf_token()}}",--}}
    {{--                    product_qty: quantity,--}}
    {{--                    product_id: pro_id--}}
    {{--                },--}}
    {{--                success: function (response) {--}}

    {{--                    // Swal.fire(--}}
    {{--                    //     'Added to Cart!',--}}
    {{--                    //     'Product successfully added to cart.',--}}
    {{--                    //     'success'--}}
    {{--                    // )--}}

    {{--                    // console.log(response);--}}
    {{--                    // if (typeof (response) != 'object') {--}}
    {{--                    //     response = $.parseJSON(response);--}}
    {{--                    // }--}}
    {{--                    // if (response.status) {--}}
    {{--                    //     swal('success', response.msg, 'success').then(function () {--}}
    {{--                    //         document.location.href = document.location.href;--}}
    {{--                    //     });--}}
    {{--                    // } else {--}}
    {{--                    //     swal('error', response.msg, 'error').then(function () {--}}
    {{--                    //         document.location.href = document.location.href;--}}
    {{--                    //     });--}}
    {{--                    // }--}}
    {{--                }--}}
    {{--            })--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection
