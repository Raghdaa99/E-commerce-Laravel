@extends('frontsite.layout.master')

@section('content')
    <style type="text/css">
        .padding {
            padding: 5rem !important;
            margin: 0;
        }

        .form-control:focus {
            box-shadow: 10px 0 0 0 #ffffff !important;
            border-color: #4ca746
        }

        .panel-title {
            display: inline;
            font-weight: bold;
        }

        .display-table {
            display: table;
        }

        .display-tr {
            display: table-row;
        }

        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
    </style>
    @include('frontsite.layout.message')

    <div class="cart-table-area section-padding-100">
        <div class="container-fluid">
            <form action="{{route('checkout.store')}}" method="post"
{{--                  role="form"--}}
{{--                  class="require-validation"--}}
{{--                  data-cc-on-file="false"--}}
{{--                  data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"--}}
{{--                  id="payment-form"--}}
            >
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Checkout</h2>
                            </div>
                            @php
                                $name=explode(' ',auth()->user()->name)
                            @endphp

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="first_name" value="{{$name[0]}}"
                                           placeholder="First Name" name="first_name" required readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="last_name" value="{{$name[1]}}"
                                           placeholder="Last Name" name="last_name" required readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control" id="company" placeholder="Company Name"
                                           value="" name="company_name">
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                           value="{{$user->email}}" readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <select class="w-100" id="country" name="country">
                                        <option value="usa">United States</option>
                                        <option value="uk">United Kingdom</option>
                                        <option value="ger">Germany</option>
                                        <option value="fra">France</option>
                                        <option value="ind">India</option>
                                        <option value="aus">Australia</option>
                                        <option value="bra">Brazil</option>
                                        <option value="cana">Canada</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control mb-3" id="street_address"
                                           name="street_address"
                                           placeholder="Address" value="">
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" class="form-control" id="city" placeholder="Town" name="city"
                                           value="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" id="zipCode" placeholder="Zip Code"
                                           name="zip_code"
                                           value="">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" class="form-control" id="phone_number" min="0"
                                           placeholder="Phone No" value="" name="phone">
                                </div>
                                <div class="col-12 mb-3">
                                    <textarea name="comment" class="form-control w-100" id="comment" cols="30" rows="10"
                                              placeholder="Leave a comment about your order"></textarea>
                                </div>

                                <div class="col-12">
                                    <div class="custom-control custom-checkbox d-block mb-2">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                        <label class="custom-control-label" for="customCheck2">Create an accout</label>
                                    </div>
                                    <div class="custom-control custom-checkbox d-block">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                                        <label class="custom-control-label" for="customCheck3">Ship to a different
                                            address</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span>
                                    <span>${{App\Models\Cart::all()->where('user_id', auth()->user()->id)->sum('amount')}}</span>
                                </li>
                                <li><span>delivery:</span> <span>Free</span></li>
                                <li><span>total:</span>
                                    <span>${{App\Models\Cart::all()->where('user_id', auth()->user()->id)->sum('amount')}}</span>
                                </li>
                            </ul>

                            <div class="payment-method">
                                <!-- Cash on delivery -->
                                <form-group>

                                    <input class="cod" type="radio" value="cod"
                                           name="payment_method" checked>
                                    <label class="custom-control-label">Cash on
                                        Delivery</label>
                                    <br>
                                    <!-- Paypal -->

                                    <input class="paypal" type="radio" value="paypal"
                                           name="payment_method">
                                    <label class="custom-control-label">Paypal <img
                                            class="ml-15"
                                            src="img/core-img/paypal.png"
                                            alt=""></label>

                                </form-group>

                            </div>
                            <div class="padding" style="display: none">

                                <div class="col-md-12">
                                    <div class="panel panel-default credit-card-box">

                                        <div class="panel-body">
                                            @if (Session::has('success'))
                                                <div class="alert alert-success text-center">
                                                    <a href="#" class="close" data-dismiss="alert"
                                                       aria-label="close">×</a>
                                                    <p>{{ Session::get('success') }}</p>
                                                </div>
                                            @endif
                                            <div class='form-row row'>
                                                <div class='col-xs-12 form-group required'>
                                                    <label class='control-label'>Name on Card</label> <input
                                                        class='form-control' size='4' type='text'>
                                                </div>
                                            </div>
                                            <div class='form-row row'>
                                                <div class='col-xs-12 form-group card required'>
                                                    <label class='control-label'>Card Number</label> <input
                                                        autocomplete='off' class='form-control card-number' size='20'
                                                        type='text' name="card_no">
                                                </div>
                                            </div>
                                            <div class='form-row row'>
                                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                    <label class='control-label'>CVC</label> <input autocomplete='off'
                                                                                                    class='form-control card-cvc'
                                                                                                    placeholder='ex. 311'
                                                                                                    size='4'
                                                                                                    type='text'
                                                                                                    name="cvvNumber">
                                                </div>
                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                    <label class='control-label'>Expiration Month</label> <input
                                                        class='form-control card-expiry-month' placeholder='MM' size='2'
                                                        type='text' name="ccExpiryMonth">
                                                </div>
                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                    <label class='control-label'>Expiration Year</label> <input
                                                        class='form-control card-expiry-year' placeholder='YYYY'
                                                        size='4'
                                                        type='text' name="ccExpiryYear">
                                                </div>
                                            </div>
                                            <div class='form-row row'>
                                                <div class='col-md-12 error form-group hide'>
                                                    <div class='alert-danger alert'>Please correct the errors and try
                                                        again.
                                                    </div>
                                                </div>
                                            </div>
{{--                                            <div class="row">--}}
{{--                                                <div class="col-xs-12">--}}
{{--                                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay--}}
{{--                                                        Now ($100)--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-btn mt-100">
                                {{--                            <form action="{{route('paypal_call')}}" method="post">--}}
                                {{--                                @csrf--}}
                                <button type="submit" class="btn amado-btn w-100">Continue</button>
                                <a href="{{route('checkout')}}" class="btn amado-btn w-100">Back</a>

                                {{--                            </form>--}}
                                {{--                            <a href="{{route('make.payment')}}" class="btn amado-btn w-100">Checkout</a>--}}
{{--                                <div id="paypal-payment-button">--}}

{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>


    </div>
@endsection

@section('title')
    Home
@endsection
@section('scripts')
{{--    <script--}}
{{--        src="https://www.paypal.com/sdk/js?client-id=Ab__4IsKdXLZwlOIUZWlquOYbxo88Gizgoa4ueohT__nw0DoB17DGyJHzIY87siZaHHysiPdmYqSfQhL&disable-funding=credit,card"></script>--}}
{{--    <script>paypal.Buttons({--}}
{{--                style: {--}}
{{--                    color: 'blue',--}}
{{--                    shape: 'pill',--}}
{{--                    marginTop: 15,--}}
{{--                },--}}

{{--                createOrder: function (data, actions) {--}}
{{--                    return actions.order.create({--}}
{{--                        purchase_units: [--}}
{{--                            {--}}
{{--                                amount: {--}}
{{--                                    value: '0.1'--}}
{{--                                }--}}
{{--                            }--}}
{{--                        ]--}}
{{--                    })--}}
{{--                },--}}
{{--                onApprove: function (data, actions) {--}}
{{--                    return actions.order.capture().then(function (details) {--}}
{{--                        console.log(details)--}}
{{--                    })--}}
{{--                }--}}
{{--            }--}}
{{--        ).render('#paypal-payment-button');</script>--}}

{{--    <script>--}}
{{--        $('.paypal, .cod').click(function () {--}}
{{--            if ($('.cod').is(':checked')) {--}}
{{--                $('.padding').hide();--}}
{{--            }--}}
{{--            if ($('.paypal').is(':checked')) {--}}
{{--                $('.padding').show();--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        $(function () {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function (e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');
                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });
                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }
            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }
        });
    </script>
@endsection
