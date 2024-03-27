<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function getAuthenticatedCustomer(){
        $customer = Auth::guard('customer')->user();
        return response()->json($customer);
    }
}
