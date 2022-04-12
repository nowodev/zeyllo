<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @param \App\Http\Requests\UpdateProductRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function popular(): JsonResponse
    {
        $products = Product::query()->latest()->take(5)->get();

        return response()->json([
            'data' => $products
        ]);
    }

    public function recommended(): JsonResponse
    {
        $products = Product::query()->inRandomOrder()->take(5)->get();

        return response()->json([
            'data' => $products
        ]);
    }
}
