<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller {
    /**
     * Register new user.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register( Request $request ) {
        try {
            $validatedData             = $request->validate( [
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users',
                'password' => 'required|string|min:6',
            ] );
            $validatedData['password'] = Hash::make( $request->password );
            $user                      = User::create( $validatedData );

            return response()->json( $user, 201 );
        } catch ( ValidationException $e ) {
            return response()->json( [ 'error' => $e->errors() ], 422 );
        }
    }
}
