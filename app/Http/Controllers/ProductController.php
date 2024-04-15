<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatusEnum;
use App\Enums\UserRoleEnum;
use App\Http\Requests\ProductRequest;
use App\Mail\ProductCreated;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();

        $statuses = ProductStatusEnum::cases();

        return view('products.index', compact('products', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        Mail::to(config('products.mail.email'))->queue(new ProductCreated($product));

        return response()->json(['success'=> true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json([
            'success' => true,
            'product' => new ProductResource($product)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        if (!auth()->user()->isAdmin() && $request->article != $product->article){

            return response()->json(['success'=> false, 'msg'=> 'This user cannot edit article field!'], 422);
        }
        $product->update($request->validated());

        return response()->json(['success'=> true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['success'=> true]);
    }
}
