<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * It checks if the user is authenticated, if yes, it returns the user's data and a token
     * 
     * @param Request request The request object.
     */
    public function user_login(Request $request)
    {
        /* Validating the request object. */
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /* Validating the request object. */
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        /* Checking if the user is authenticated, if yes, it returns the user's data and a token. */
        if(auth()->guard('user')->attempt(['email' => request('email'), 'password' => request('password')])){

            /* Setting the default guard to user. */
            config(['auth.guards.api.provider' => 'user']);
            
            /* Getting the user's data from the database. */
            $user = User::find(auth()->guard('user')->user()->id);
            /* Assigning the user's data to the  variable. */
            $success =  $user;
            /* Creating a token for the user. */
            $success['token'] =  $user->createToken('The-Code-Studio-Auth', ['user'])->accessToken; 

            return response()->json($success, 200);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }

    }

    public function customer_login(Request $request)
    {
        /* Validating the request object. */
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        /* Validating the request object. */
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        /* Checking if the user is authenticated, if yes, it returns the user's data and a token. */
        if(auth()->guard('customer')->attempt(['email' => request('email'), 'password' => request('password')])){

            /* Setting the default guard to user. */
            config(['auth.guards.api.provider' => 'customer']);
            
            /* Getting the user's data from the database. */
            $customer = Customer::find(auth()->guard('customer')->user()->id);
            /* Assigning the user's data to the  variable. */
            $success =  $customer;
            /* Creating a token for the user. */
            $success['token'] =  $customer->createToken('The-Code-Studio-Auth', ['customer'])->accessToken; 

            return response()->json($success, 200);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }

    }
    //ENDS
}
