<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function options(): JsonResponse
    {
        return response()->json([
            'users' => User::query()
                ->select(['id', 'name'])
                ->orderBy('name')
                ->get(),
        ]);
    }
}
