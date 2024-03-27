<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getAuthenticateduser(){
        $user = Auth::guard('user')->user();
        return response()->json($user);
    }
}
