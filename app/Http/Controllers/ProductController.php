<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller {

    /**
     * Display products list.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $products = Product::all(); // Assuming Product is your Eloquent model representing the products table

        return response()->json( $products, 200 );
    }

    /**
     * Insert new product
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store( Request $request ) {
        try {
            $validatedData = $request->validate( [
                'name'        => 'required|string|max:255',
                'description' => 'nullable|string',
                'price'       => 'required|numeric',
            ] );

            $product = Product::create( $validatedData );

            return response()->json( $product, 201 );
        } catch ( ValidationException $e ) {
            return response()->json( [ 'error' => $e->errors() ], 422 );
        }
    }

    /**
     * Update product data
     *
     * @param Request $request
     * @param Product $product
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update( Request $request, Product $product ) {
        try {
            $validatedData = $request->validate( [
                'name'        => 'required|string|max:255',
                'description' => 'nullable|string',
                'price'       => 'required|numeric',
            ] );

            $product->update( $validatedData );

            return response()->json( $product, 200 );
        } catch ( ValidationException $e ) {
            return response()->json( [ 'error' => $e->errors() ], 422 );
        }
    }

    /**
     * Delete product.
     *
     * @param Product $product
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy( Product $product ) {
        $product->delete();

        return response()->json( [ 'message' => 'Product deleted' ], 200 );
    }

    /**
     * Get product object by ID.
     *
     * @param Product $product
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show( Product $product ) {
        return response()->json( $product, 200 );
    }
}
