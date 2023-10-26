<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJsonRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $headers = [
            'Accept' => ['application/json'],
            'Content-Type' => [
                'application/json',
                'multipart/form-data',
                'application/x-www-form-urlencoded'
            ],
        ];

        foreach ($headers as $headerName => $values) {
            $isValidHeader = false;
            foreach ($values as $header) {
                if (
                    str_starts_with(
                        $request->headers->get($headerName),
                        $header
                    )
                ) {
                    $isValidHeader = true;
                    break;
                }
            }

            if (!$isValidHeader) {
                $request->headers->set($headerName, 'application/json');
            }
        }

        return $next($request);
    }
}
