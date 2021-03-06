<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = Product::query()->paginate(10);

        return response()->json([
            'status_code' => 200,
            'data' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3|max:1000',
            'price' => 'required|numeric',
            'stars' => 'required|numeric|digits_between:1,5',
            'img' => 'required|string',
            'location' => 'required|string|min:3|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Error Validation',
                'data' => [
                    $validator->errors()
                ],
            ]);
        }

        $product = Product::query()->create($input);

        return response()->json([
            'status_code' => 200,
            'message' => 'Product Added',
            'data' => $product,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'status_code' => 200,
            'data' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3|max:1000',
            'price' => 'required|numeric',
            'stars' => 'required|numeric|digits_between:1,5',
            'img' => 'required|string',
            'location' => 'required|string|min:3|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Error Validation',
                'data' => [
                    $validator->errors()
                ],
            ]);
        }

        $product->update($input);

        return response()->json([
            'status_code' => 200,
            'message' => 'Product Updated',
            'data' => $product,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Product Deleted',
        ]);
    }

    public function popular(): JsonResponse
    {
        $products = Product::query()->latest()->take(5)->get();

        return response()->json([
            'status_code' => 200,
            'data' => $products
        ]);
    }

    public function recommended(): JsonResponse
    {
        $products = Product::query()->inRandomOrder()->take(5)->get();

        return response()->json([
            'status_code' => 200,
            'data' => $products
        ]);
    }
}
