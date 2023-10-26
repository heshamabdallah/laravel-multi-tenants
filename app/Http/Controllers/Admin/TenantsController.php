<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTenantRequest;
use App\Models\Tenant;
use Illuminate\Pagination\Paginator;

class TenantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Pagination\Paginator
     */
    public function index(): Paginator
    {
        return Tenant::simplePaginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\StoreTenantRequest  $request
     * @return array
     */
    public function store(StoreTenantRequest $request): array
    {
        $tenant = Tenant::create(
            $request->safe([
                'name'
            ])
        );

        $tenant->domains()
            ->create(
                $request->safe([
                    'domain'
                ])
            );

        return compact('tenant');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tenant  $tenant
     * @return array
     */
    public function show(Tenant $tenant): array
    {
        return compact('tenant');
    }
}
