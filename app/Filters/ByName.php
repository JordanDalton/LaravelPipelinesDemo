<?php

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ByName
{
    public function __construct(public Request $request){}

    public function handle(Builder $query, Closure $next)
    {
        return $next($query)
            ->when($this->request->has('name'),
                fn($query) => $query->where('name', 'regexp', $this->request->name)
            );
    }
}
