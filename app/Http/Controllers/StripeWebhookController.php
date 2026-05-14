<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    public function handel(Request $request){
        Log::debug('webhook event',$request->all());
    }
}
