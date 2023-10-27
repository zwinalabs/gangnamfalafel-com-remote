<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Hiboutik\HiboutikController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Hiboutik Gateway API request
 */
Route::group(['middleware' => ['api']], function(){
    Route::get('/new-sale-hiboutik', 'API\Hiboutik\HiboutikController@newSale')->name('hiboutik.newSale');
    Route::get('/close-sale-hiboutik', 'API\Hiboutik\HiboutikController@closeSale')->name('hiboutik.closeSale');
    Route::get('/add-product-sale-hiboutik', 'API\Hiboutik\HiboutikController@addProductToSale')->name('hiboutik.addProductToSale');
    Route::get('/print-receipt-hiboutik', 'API\Hiboutik\HiboutikController@printReceipt')->name('hiboutik.printReceipt');
    Route::get('/print-receipt-kitchen-hiboutik', 'API\Hiboutik\HiboutikController@printReceiptKitchen')->name('hiboutik.printReceiptKitchen');
    Route::get('/print-receipt-order-hiboutik', 'API\Hiboutik\HiboutikController@printOrderHiboutik')->name('hiboutik.printOrderHiboutik');
    Route::post('/stripe-payment-intents-create', 'API\Stripay\StripayController@stripePost')->name('stripe.postPaymentIntents');
    Route::post('/stripe-payment-retrieve', 'API\Stripay\StripayController@stripeCharges')->name('stripe.retrievePayment');
});