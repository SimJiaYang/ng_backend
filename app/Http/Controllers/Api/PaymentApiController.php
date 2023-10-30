<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe;
use Exception;


class PaymentApiController extends Controller
{

    public function paymentIntent(Request $request)
    {
        $request->validate([
            'amount' => ['required'],
        ]);;

        $stripeClient = new Stripe\StripeClient(
            config('services.stripe.STRIPE_SECRET_KEY')
        );

        // Create a PaymentIntent with amount and currency
        $paymentIntent = $stripeClient->paymentIntents->create([
            'amount' => ($request->amount) * 20,
            'currency' => 'myr',
            'automatic_payment_methods' => [
                'enabled' => true
            ]
        ]);

        $ret['Client_Secret'] = $paymentIntent->client_secret;

        return $this->success($ret);
    }
}
