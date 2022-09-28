<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use Inertia\Inertia;
use Stripe\Customer;
use Stripe\StripeClient;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class paymentcontroller extends Controller
{
    public function index(){
        $data = "payment readt";
        return Inertia('payment',['data' => $data]);
    }
    public function pay(Request $request){
        $getuser = "izuuarch";
        $email = "izuuarch@gmail.com";
        $this->validate($request, [
            'payment_name' => 'required',
            'payment_amount' => 'required',
            'payment_description' => 'required',
            'card_number' => 'required',
            'card_cvc' => 'required',
            'card_expiry_month' => 'required',
            'card_expiry_year' => 'required'
        ]);
        try {
        
            $stripekey = array(
                "secret_key" => env('STRIPE_SECRET_KEY'),
                "pub_key" => env('STRIPE_PUB_KEY')
              );
               //  create token
        $stripe = new StripeClient(
            env('STRIPE_SECRET_KEY')
          );
          $token = $stripe->tokens->create([
            'card' => [
              'number' => $request->card_number,
              'exp_month' => $request->card_expiry_month,
              'exp_year' => $request->card_expiry_year,
              'cvc' => $request->card_cvc,
            ],
          ]);
          
              Stripe::setApiKey($stripekey['secret_key']);    
        // add to stripe
        $customer = Customer::create(array(
            'email' => $email,
            'source'  => $token
        ));
          
        $orderid = Str::random(10);
        $paymentdetails = Charge::create(array(
            'customer' => $customer->id,
            'amount'   => $request->payment_amount,
            'currency' => 'usd',
            'description' => $request->payment_description,
            'metadata' => array(
                'order_id' => $orderid
            )
        ));
        $statusresponse = $paymentdetails->jsonSerialize();
        if($statusresponse['amount_refunded'] == 0 && empty($statusresponse['failure_code'])){
            $transaction = new transaction;
            $userid = "izuuarch";
            $transaction->payment_name = $request->payment_name;
            $transaction->userid = md5($userid);
            $transaction->payment_status = $statusresponse['status'];
            $transaction->payment_amount = $request->payment_amount;
            $transaction->transaction_id = $statusresponse['id'];
                return redirect(route('payment'));
            
        }

        
        } catch(\Stripe\Exception\ApiErrorException $e) {
            $return_array = [
                "status" => $e->getHttpStatus(),
                "type" => $e->getError()->type,
                "code" => $e->getError()->code,
                "param" => $e->getError()->param,
                "message" => $e->getError()->message,
            ];
            $return_str = json_encode($return_array);          
            http_response_code($e->getHttpStatus());
            echo $return_str;
        }

    }
    public function users(){
        $users = User::all();
        return Inertia('users',['users' => $users]);
    }
}
