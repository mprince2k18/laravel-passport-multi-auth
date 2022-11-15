<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    /**
     * We create a new user, save it to the database, create a token for it, and return the token
     * 
     * @param Request request This is the request object that contains the data that was sent to the
     * API.
     * 
     * @return A token is being returned.
     */
    public function user_register(Request $request)
    {
        /* Creating a new user, saving it to the database, creating a token for the user, and
        returning the token. */
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        /* Creating a token for the user. */
        $token = $user->createToken('The-Code-Studio-Auth')->accessToken;

        /* Returning a token. */
        return response()->json(['token' => $token], 200);
    }

    /**
     * It creates a new customer, saves it to the database, creates a token for the customer, and
     * returns the token
     * 
     * @param Request request The request object.
     * 
     * @return A token is being returned.
     */
    public function customer_register(Request $request)
    {
        /* Creating a new customer, saving it to the database, creating a token for the customer, and
        returning the token. */
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->save();

        /* Creating a token for the customer. */
        $token = $customer->createToken('The-Code-Studio-Auth')->accessToken;

        /* Returning a token. */
        return response()->json(['token' => $token], 200);
    }
    
    //ENDS
}
