<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller {
    /**
     * Insert new user.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store( Request $request ) {
        try {
            $request->validate( [
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users',
                'password' => 'required|string|min:6',
            ] );

            User::create( [
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt( $request->password ),
            ] );

            return response()->json( [ 'message' => 'User created successfully' ], 201 );
        } catch ( ValidationException $e ) {
            return response()->json( [ 'error' => $e->errors() ], 422 );
        }
    }
}
