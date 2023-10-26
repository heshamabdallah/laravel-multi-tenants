<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Pagination\Paginator
     */
    public function index(): Paginator
    {
        return Order::latest()
            ->with([
                'user',
                'products' => fn($query) => $query->withPivot('quantity')
            ])
            ->simplePaginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Tenant\StoreOrderRequest  $request
     * @return array
     */
    public function store(StoreOrderRequest $request): array
    {
        return DB::transaction(function () use ($request) {
            $mappedProductsWithId = Product::whereIn('id', $request->validated('products.*.product_id'))
                ->get(['id', 'price'])
                ->mapWithKeys(fn($product) => [
                    $product->id => $product->price
                ]);

            $amount = array_reduce(
                $request->validated('products'),
                fn($carry, $item) => $carry + ($item['quantity'] * $mappedProductsWithId[$item['product_id']]),
                0
            );

            $order = Order::create([
                ...$request->safe([
                    'user_id'
                ]),
                'amount' => round($amount, 2),
                // For simplicity we use one currency, if the products have multiple currencies
                // Then when an order is created we need to do currency conversion to a base currency
                'currency' => 'EGP',
            ]);

            $order->products()
                ->sync($request->validated('products'));

            $order->load([
                'user',
                'products' => fn($query) => $query->withPivot('quantity')
            ]);

            return compact('order');
        });
    }

    /**
     * Display the specified resource.
     *
     * @return array
     */
    public function show(Order $order): array
    {
        $order->load([
            'user',
            'products' => fn($query) => $query->withPivot('quantity')
        ]);

        return compact('order');
    }
}
