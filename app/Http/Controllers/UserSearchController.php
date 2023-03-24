<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;

class UserSearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
        $pipelines = [
            \App\Filters\ByEmail::class,
            \App\Filters\ByName::class,
            \App\Filters\ByDob::class,
        ];

        return Pipeline::send(User::query())
            ->through($pipelines)
            ->thenReturn()
            ->paginate();
    }
}
