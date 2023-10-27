<?php

namespace App\Http\Controllers\API\Stripay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Orders\OrderRepoGenerator;
use App\Order;
use Carbon\Carbon;
use App\Status;
use App\Paths;
use Session;
use Stripe;
use Stripe\Exception\CardException;
use Stripe\StripeClient;


class StripayController extends Controller
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(config('settings.stripe_secret'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
            /**
     * stripePost Stripe : create new stripe payment intent
     *
     * @param  mixed $printing_gateway
     * @param  mixed $store_id
     * @return sale_id
     */
    public function stripePost(Request $request){
        try {
            // retrieve JSON from POST body
            $jsonStr = $request->getContent();
            $jsonObj = json_decode($jsonStr);
            
            // Create a PaymentIntent with amount and currency
            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => 1*100,
                'currency' => config('settings.cashier_currency'),
                // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);
        
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            return response()->json($output);
            //echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
            /**
     * newSale Hiboutik: create new sale at hiboutik
     *
     * @param  mixed $printing_gateway
     * @param  mixed $store_id
     * @return sale_id
     */
    public function stripeCharges(Request $request){
        try {
            $pi_client_secret = $request->pi_client_secret;
            // Create a PaymentIntent with amount and currency
            $paymentConfirm = $this->stripe->paymentIntents->confirm(
                $pi_client_secret
            );
        
            return response()->json($paymentConfirm);
        
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
