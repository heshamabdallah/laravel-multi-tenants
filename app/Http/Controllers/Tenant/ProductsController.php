<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreProductRequest;
use App\Models\Product;
use Illuminate\Pagination\Paginator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Pagination\Paginator
     */
    public function index(): Paginator
    {
        return Product::latest()
            ->simplePaginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Tenant\StoreProductRequest  $request
     * @return array
     */
    public function store(StoreProductRequest $request): array
    {
        $product = Product::create($request->validated());

        return compact('product');
    }

    /**
     * Display the specified resource.
     *
     * @return array
     */
    public function show(Product $product): array
    {
        return compact('product');
    }
}
