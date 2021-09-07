@extends('frontsite.layout.master')

@section('content')

    <div class="cart-table-area section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="cart-title mt-50">
                        <h2>Shopping Cart</h2>
                    </div>

                    <div class="cart-table clearfix">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carts as $cart)

                                <tr>
                                    <td class="cart_product_img">
                                        <a href="#"><img src="{{asset('product_images/'.$cart->product->image)}}"
                                                         alt="Product"></a>
                                    </td>
                                    <td class="cart_product_desc">
                                        <h5>{{$cart->product->name}}</h5>
                                    </td>
                                    <td class="price">
                                        <span id="amount-{{$cart->id}}">${{$cart->amount}}</span>
                                        <input type="hidden" id="price-{{$cart->id}}" value="{{$cart->price}}">
                                    </td>
                                    <td class="qty">
                                        <div class="qty-btn d-flex">
                                            <p>Qty</p>
                                            <div class="quantity">

                                                <span class="qty-minus" data-id="{{$cart->id}}">
{{--                                                     onclick="var effect = document.getElementById('qty-input-{{$cart->id}}'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;">--}}

                                                    <i class="fa fa-minus" aria-hidden="true"></i></span>
                                                <input type="number" class="qty-text" id="qty-input-{{$cart->id}}"
                                                       step="1"
                                                       min="1" data-id="{{$cart->id}}"
                                                       max="300" name="quantity" value="{{$cart->quantity}}">
                                                <input type="hidden" data-id="{{$cart->id}}"
                                                       id="update-cart-{{$cart->id}}"
                                                       data-product-quantity="{{$cart->quantity}}">
                                                <span class="qty-plus" id="plus" data-id="{{$cart->id}}"
{{--                                                      onclick="var effect = document.getElementById('qty-input-{{$cart->id}}'); var qty = effect.value; if( !isNaN( qty )) effect.value++;--}}
                                                    {{--var price = {{$cart->price}};--}}
                                                    {{--var amount =document.getElementById('amount');--}}
                                                    {{--amount.innerText =  (effect.value*price);--}}
                                                          >



                                                    <i class="fa fa-plus" aria-hidden="true"></i></span>
                                                {{--                                                <script>--}}
                                                {{--                                                    var id_cart = {{$cart->id}};--}}
                                                {{--                                                    // var val = document.getElementById(id_cart).value;--}}
                                                {{--                                                    document.getElementById(id_cart).onclick = function () {--}}
                                                {{--                                                        var id_cart = {{$cart->id}};--}}
                                                {{--                                                        var val = document.getElementById(id_cart).value;--}}
                                                {{--                                                        console.log(val)--}}
                                                {{--                                                    }--}}
                                                {{--                                                    var plus = document.getElementById('plus');--}}
                                                {{--                                                    plus.addEventListener('click',function (){--}}
                                                {{--                                                        var effect = document.getElementById('{{$cart->id}}');--}}
                                                {{--                                                        var qty = effect.value;--}}
                                                {{--                                                        if( !isNaN( qty )) effect.value++;--}}
                                                {{--                                                    },false)--}}
                                                {{--                                                </script>--}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="cart-summary">
                        <h5>Cart Total</h5>
                        <ul class="summary-table">
                            <li><span>subtotal:</span> <span>${{$total}}</span></li>
                            <li><span>delivery:</span> <span>Free</span></li>
                            <li><span>total:</span> <span>${{$total}}</span></li>
                        </ul>
                        {{--                        <div class="cart-btn mt-100">--}}
                        {{--                            <a href="cart.blade.php" class="btn amado-btn w-100">Checkout</a>--}}
                        {{--                        </div>--}}
                        {{--                        <form method="post" action="{{route('frontsite.checkout')}}">--}}
                        @csrf
                        <input type="hidden" name="amount" value="{{ $total }}">
                        <div class="cart-btn mt-100">
                            <a href="{{route('frontsite.checkout')}}" class="btn amado-btn w-100" type="submit"
                               name="paynow">Pay Now</a>
                        </div>
                        {{--                        </form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('title')
    Cart
@endsection
@section('scripts')
    <script>
        $(document).on('click', '.qty-plus', function (e) {
            var id = $(this).data('id');
            var effect = document.getElementById('qty-input-' + id);
            var qty = effect.value;
            if (!isNaN(qty)) effect.value++;
            var price = document.getElementById('price-' + id).value;
            var amount = document.getElementById('amount-' + id);
            // console.log(price+'  '+amount.value)
            amount.innerText = '$'+(effect.value * price);
            var productQuantity = $('#update-cart-' + id).data('product-quantity');
            update_cart(id, productQuantity);
            return false;
        });
        $(document).on('click', '.qty-minus', function (e) {
            var id = $(this).data('id');
            var effect = document.getElementById('qty-input-' + id);
            var qty = effect.value;
            if (!isNaN(qty)) effect.value--;
            var price = document.getElementById('price-' + id).value;
            var amount = document.getElementById('amount-' + id);
            // console.log(price+'  '+amount.value)
            amount.innerText = '$'+(effect.value * price);
            var productQuantity = $('#update-cart-' + id).data('product-quantity');
            update_cart(id, productQuantity);
            return false;
        });
        // $(document).on('click', '.qty-text', function (e) {
        //     e.preventDefault();
        //     // var quantity = $(this).data('quantity');
        //     var id = $(this).data('id');
        //
        // });

        function update_cart(id, productQuantity) {
            var cart_id = id;
            var product_qty = $('#qty-input-' + id).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: "{{route('cart.update')}}",
                type: "POST",
                data: {
                    _token: token,
                    product_qty: product_qty,
                    cart_id: cart_id,
                    productQuantity: productQuantity,
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (err) {
                    // console.log(err);
                }
            })

        }

        // $("#qty").on("input", function () {
        //     var quantity = $(this).data('quantity');
        //     alert(quantity);
        // });
    </script>
@endsection
