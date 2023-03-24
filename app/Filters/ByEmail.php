<?php

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ByEmail
{
    public function __construct(public Request $request){}

    public function handle(Builder $query, Closure $next)
    {
        return $next($query)
            ->when($this->request->has('email'),
                fn($query) => $query->where('email', 'regexp', $this->request->email)
            );
    }
}
