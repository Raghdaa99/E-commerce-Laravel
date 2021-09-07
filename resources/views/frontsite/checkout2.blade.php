@extends('frontsite.layout.master')

@section('content')

            <div class="row">
                <form action="{{route('checkout2.store')}}" method="post">
                    @csrf

                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Shippings</h2>
                        </div>
                    </div>


                    {{--    @if ($message = Session::get('success'))--}}
                    {{--        <div class="alert alert-success">--}}
                    {{--            <p>{{ $message }}</p>--}}
                    {{--        </div>--}}
                    {{--    @endif--}}


                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Method</th>
                            <th>Delivery Time</th>
                            <th>Price</th>
                            <th>Choose</th>
                        </tr>
                        @foreach ($shippings as $shipping)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $shipping->shippings_address }}</td>
                                <td>{{ $shipping->delivery_time }}</td>
                                <td>{{ $shipping->delivery_charge }}</td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="shipping_id"
                                               value="{{$shipping->id}}" id="{{$shipping->id}}">
                                        <label class="form-check-label" for="{{$shipping->id}}">

                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="cart-btn mt-100">
                        {{--                            <form action="{{route('paypal_call')}}" method="post">--}}
                        {{--                                @csrf--}}
                        <a href="{{route('checkout2.store')}}" class="btn amado-btn w-100">Back</a>
                        <button type="submit" class="btn amado-btn w-100">Continue</button>
                        {{--                            </form>--}}
                        {{--                            <a href="{{route('make.payment')}}" class="btn amado-btn w-100">Checkout</a>--}}
                    </div>
                </form>
            </div>

@endsection

