<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function user_register(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $token = $user->createToken('The-Code-Studio-Auth')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function customer_register(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->save();

        $token = $customer->createToken('The-Code-Studio-Auth')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    
    //ENDS
}
