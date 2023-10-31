<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    /**
     * Login user and return token.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login( Request $request ) {
        $credentials = $request->only( 'email', 'password' );

        if ( Auth::attempt( $credentials ) ) {
            $user  = Auth::user();
            $token = $user->createToken( 'authToken' )->plainTextToken;

            return response()->json( [ 'token' => $token ], 200 );
        }

        return response()->json( [ 'message' => 'Unauthorized' ], 401 );
    }
}
