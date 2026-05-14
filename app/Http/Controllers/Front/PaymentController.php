<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\payment;
use Illuminate\Database\QueryException;

class PaymentController extends Controller
{
    public function create(Order $order){
    
        return view('Front.payments',[
            'order'=>$order
        ]);
    }
    public function createStripePaymentIntent(Order $order){
        $amount=$order->items->sum(function($items){
            return ($items->price * $items->quantity);
        });
        $stripe = new \Stripe\StripeClient(config('services.stripe.Secret_key'));
$paymentIntent = $stripe->paymentIntents->create([
  'amount' => (int) round($amount * 100),
  'currency' => 'usd',
  'automatic_payment_methods' => ['enabled' => true],
]);
return [
    'clientSecret'=>$paymentIntent->client_secret,
];
    }
     public function confirm(Request $request, Order $order)
    {
        
        //   $stripe = App::make('stripe.client');
                $stripe = new \Stripe\StripeClient(config('services.stripe.Secret_key'));

        $paymentIntent = $stripe->paymentIntents->retrieve(
            $request->query('payment_intent'),
            []
        );
       if ($paymentIntent->status == 'succeeded') {
            try {
                // Update payment
                $payment = new payment();
                 $payment->forceFill([
                'order_id' => $order->id,
                'amount' => $paymentIntent->amount,
                'currancy' => $paymentIntent->currency,
                'method' => 'stripe',
                'status' => 'pending',
                'transaction_id' => $paymentIntent->id,
                'transaction_data' => json_encode($paymentIntent),
            ])->save();

            } catch (QueryException $e) {
                echo $e->getMessage();
                return;
            }

            event('payment.created', $payment->id);

            return redirect()->route('home', [
                'status' => 'payement-succeeded'
            ]);
        }

        return redirect()->route('orders.payments.create', [
            'order' => $order->id,
            'status' => $paymentIntent->status,
        ]);
        
    
    }
}

