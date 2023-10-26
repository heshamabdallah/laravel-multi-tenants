<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreUserRequest;
use App\Models\User;
use Illuminate\Pagination\Paginator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Pagination\Paginator
     */
    public function index(): Paginator
    {
        return User::latest()
            ->simplePaginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Tenant\StoreUserRequest  $request
     * @return array
     */
    public function store(StoreUserRequest $request): array
    {
        $user = User::create($request->validated());

        return compact('user');
    }

    /**
     * Display the specified resource.
     *
     * @return array
     */
    public function show(User $user): array
    {
        return compact('user');
    }
}
