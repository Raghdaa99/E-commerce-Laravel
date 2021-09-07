<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipping;


use Cartalyst\Stripe\Laravel\Facades\Stripe;

//use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class CheckoutController extends Controller
{
    public function checkout1()
    {
        $user = Auth::user();
        return view('frontsite.checkout', compact('user'));
    }

    public function checkout1store(Request $request)
    {
        // dd($request->all());
        $id_user = Auth::user()->id;
//        dd($charge['status']);
//        dd($id_user);
        Session::put('checkout', [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'country' => $request->country,
            'city' => $request->city,
            'street_address' => $request->street_address,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone,
            'comment' => $request->comment,
            'payment_method' => $request->payment_method,
            'total_price' => Cart::orderBy('created_at', 'desc')->where('user_id', $id_user)->sum('amount'),
        ]);
        $shippings = Shipping::orderBy('shippings_address', 'Asc')->where('status', 'active')->get();
//        dd($request->payment_method);
        if ($request->payment_method == 'cod') {

            return view('frontsite.checkout2', compact('shippings'));
        } elseif ($request->payment_method == 'paypal') {
            return $this->orderByPaypal($request);
//            $strip = Stripe::make(env('STRIPE_SECRET'));
//            $order = new Order();
//            try {
////
//                $token = $strip->tokens()->create([
//                    'card' => [
//                        'number' => $request->get('card_no'),
//                        'exp_month' => $request->get('ccExpiryMonth'),
//                        'exp_year' => $request->get('ccExpiryYear'),
//                        'cvc' => $request->get('cvvNumber'),
//                    ],
//                ]);
//                //dd($token['id']);
//                if (!isset($token['id'])) {
//
//                    \session()->flash('strip_error', 'the strip token was not generated correctly');
//                }
////                $customer = $strip->customers()->create([
////                    'name' => $request->first_name . ' ' . $request->last_name,
////                    'address' => [
////                        'postal_code' => $request->zip_code,
////                        'country' => $request->country,
////                        'city' => $request->city,
////                        'street_address' => $request->street_address,
////                    ],
////                    'source' => $request->stripeToken,
////
////                ]);
//
//                $charge = $strip->charges()->create([
//                    "source" => $request->stripeToken,
////                    'customer' => $customer['id'],
//                    'currency' => 'USD',
//                    'amount' => Cart::orderBy('created_at', 'desc')->where('user_id', $id_user)->sum('amount'),
//                    'description' => 'Payments For order no' . $order->id
//                ]);
//
////                dd($charge['status']);
//                if ($charge['status'] == 'succeeded') {
//
//                    $order->user_id = $id_user;
//                    $order->order_number = Str::upper('ORD-' . Str::random(8));
//                    $order->first_name = Session::get('checkout')['first_name'];
//                    $order->last_name = Session::get('checkout')['last_name'];
//                    $order->company_name = Session::get('checkout')['company_name'];
//                    $order->email = Session::get('checkout')['email'];
//                    $order->country = Session::get('checkout')['country'];
//                    $order->city = Session::get('checkout')['city'];
//                    $order->street_address = Session::get('checkout')['street_address'];
//                    $order->zip_code = Session::get('checkout')['zip_code'];
//                    $order->comment = Session::get('checkout')['comment'];
//                    $order->phone = Session::get('checkout')['phone'];
////                    $order->shipping_id = Session::get('checkout')[0]['shipping_id'];
//
//                    $order->payment_method = 'paypal';
//                    $order->payment_status = 'paid';
//                    //dd('44444');
//                    $order->total_price = Session::get('checkout')['total_price'];
//                    $order->street_address = Session::get('checkout')['street_address'];
//
//
//                    $order->save();
//                    $this->resetCart($id_user);
//                    return redirect()->route('checkout')->with('success_order', 'Your Order Number #' . $order->order_number);
//
//                } else {
//
//                    return redirect()->route('checkout')->with('error', 'Money not add in wallet!!');
//                }
//            } catch (\Exception $e) {
//                \session()->flash('strip_error', $e->getMessage());
//            }
//            $user = Auth::user();
        }

    }

    public function checkout2store(Request $request)
    {
//        $request->all();
        $id_user = Auth::user()->id;
        $carts = Cart::orderBy('created_at', 'desc')->where('user_id', $id_user)->get();
        $total = Cart::orderBy('created_at', 'desc')->where('user_id', $id_user)->sum('amount');
        //  dd($request->shipping_id);
        Session::push('checkout', [
            'shipping_id' => $request->shipping_id,
            'payment_status' => 'paid',
        ]);
//      dd(Session::get('checkout')[0]['shipping_id']);
        return view('frontsite.checkout3', compact('carts', 'total'));
    }

    public function checkout3store(Request $request)
    {

        $id_user = Auth::user()->id;
        $order = new Order();
        $order->user_id = $id_user;
        $order->order_number = Str::upper('ORD-' . Str::random(8));
        $order->first_name = Session::get('checkout')['first_name'];
        $order->last_name = Session::get('checkout')['last_name'];
        $order->company_name = Session::get('checkout')['company_name'];
        $order->email = Session::get('checkout')['email'];
        $order->country = Session::get('checkout')['country'];
        $order->city = Session::get('checkout')['city'];
        $order->street_address = Session::get('checkout')['street_address'];
        $order->zip_code = Session::get('checkout')['zip_code'];
        $order->comment = Session::get('checkout')['comment'];
        $order->phone = Session::get('checkout')['phone'];
        $order->shipping_id = Session::get('checkout')[0]['shipping_id'];
        $order->payment_method = Session::get('checkout')['payment_method'];
        $order->payment_status = Session::get('checkout')[0]['payment_status'];
        $order->total_price = Session::get('checkout')['total_price'];
        $order->street_address = Session::get('checkout')['street_address'];

        $order->save();
//        $id_user = Auth::user()->id;
//        $carts = Cart::orderBy('created_at', 'desc')->where('user_id', $id_user)->get();
//        $total = Cart::orderBy('created_at', 'desc')->where('user_id', $id_user)->sum('amount');
//        return view('frontsite.checkout3', compact('carts', 'total'))->with( 'success', 'Your Order Number #' . $order->order_number);
        return redirect()->route('checkout.order')->with('success_order', 'Your Order Number #' . $order->order_number);
    }

    public function checkoutOrder()
    {
        $id_user = Auth::user()->id;
        $carts = Cart::orderBy('created_at', 'desc')->where('user_id', $id_user)->get();
        $total = Cart::orderBy('created_at', 'desc')->where('user_id', $id_user)->sum('amount');
        return view('frontsite.checkout3', compact('carts', 'total'));

    }

    public function resetCart($id_user)
    {
        $carts = Cart::all()->where('user_id', $id_user);
        foreach ($carts as $cart) {
            $cart->delete();
        }

//        return redirect()->route('post.index')->with('success', 'the Post is Deleted successful');
    }

    public function orderByPaypal(Request $request)
    {
//        dd($request-all);
        $id_user = Auth::user()->id;
        Session::put('checkout', [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'country' => $request->country,
            'city' => $request->city,
            'street_address' => $request->street_address,
            'zip_code' => $request->zip_code,
            'phone' => $request->phone,
            'comment' => $request->comment,
            'payment_method' => $request->payment_method,
            'total_price' => Cart::orderBy('created_at', 'desc')->where('user_id', $id_user)->sum('amount'),
        ]);

        $order = new Order();
        $order->user_id = $id_user;
        $order->order_number = Str::upper('ORD-' . Str::random(8));
        $order->first_name = Session::get('checkout')['first_name'];
        $order->last_name = Session::get('checkout')['last_name'];
        $order->company_name = Session::get('checkout')['company_name'];
        $order->email = Session::get('checkout')['email'];
        $order->country = Session::get('checkout')['country'];
        $order->city = Session::get('checkout')['city'];
        $order->street_address = Session::get('checkout')['street_address'];
        $order->zip_code = Session::get('checkout')['zip_code'];
        $order->comment = Session::get('checkout')['comment'];
        $order->phone = Session::get('checkout')['phone'];
//                    $order->shipping_id = Session::get('checkout')[0]['shipping_id'];

        $order->payment_method = 'paypal';
        $order->payment_status = 'paid';
        //dd('44444');
        $order->total_price = Session::get('checkout')['total_price'];
        $order->street_address = Session::get('checkout')['street_address'];


        $order->save();

        return $this->paypal($order);
    }

    public function paypal(Order $order)
    {
        $client = $this->paypalClient();
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => $order->id,
                "amount" => [
                    "value" => $order->total_price,
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                "cancel_url" => url(route('cancel.payment')),
                "return_url" => url(route('success.payment'))
            ]
        ];

        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response

            if ($response->statusCode == 201) {
                Session::put('paypal_order_id', $response->result->id);
                Session::put('order_id', $order->id);
                foreach ($response->result->links as $link) {
                    if ($link->rel == 'approve') {
                        return redirect()->away($link->href);
                    }
                }
            }

//            print_r($response);
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
        return 'Unknown Error' . $response->statusCode;
    }

    public function paypalClient()
    {
        $config = config('services.paypal');
        $environment = new SandboxEnvironment($config['client_id'], $config['client_secret']);
        $client = new PayPalHttpClient($environment);
        return $client;
    }

    public function paymentSuccess()
    {
        $paypal_order_id = Session::get('paypal_order_id');
        $request = new OrdersCaptureRequest($paypal_order_id);
        $request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $this->paypalClient()->execute($request);
            if ($response->statusCode == 201) {
                if (strtoupper($response->result->status) == 'COMPLETED') {
                    $id = Session::get('order_id');
//                    $id = $response->purchase_units[0]->reference_id;
                    $order = Order::findOrFail($id);
                    $order->status = 'process';
                    $order->save();
                    \session()->forget('paypal_order_id', 'order_id');
                    return redirect()->route('checkout')->with('success_order', 'Your Order Number #' . $order->id);

                }
            }
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            // print_r($response);
        } catch (HttpException $ex) {
            return $ex->statusCode;
            // print_r($ex->getMessage());
        }
    }

    public function paymentCancel()
    {

    }
}
