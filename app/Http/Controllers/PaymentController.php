<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function fail(Request $request)
    {
        return redirect()->back()->with('error', 'Your Payment was not Successful,Please try again!!');
    }
}
