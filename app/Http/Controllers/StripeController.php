<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class StripeController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('Stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
//       Stripe::setApiKey(env('STRIPE_SECRET'));
        $strip = Stripe::make(env('STRIPE_SECRET'));
        $strip->charges()->create ([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "This payment is tested purpose phpcodingstuff.com"
        ]);

        Session::flash('success', 'Payment successful!');

        return back();
    }
}
