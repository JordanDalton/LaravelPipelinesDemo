<?php

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ByDob
{
    public function __construct(public Request $request){}

    public function handle(Builder $query, Closure $next)
    {
        return $next($query)
            ->when($this->request->has('dob'),
                fn($query) => $query->where('dob', 'regexp', $this->request->dob)
            );
    }
}
