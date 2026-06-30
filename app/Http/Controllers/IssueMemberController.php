<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IssueMemberController extends Controller
{
    public function store(Request $request, Issue $issue): JsonResponse
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $issue->members()->syncWithoutDetaching([$data['user_id']]);

        $user = User::find($data['user_id']);

        return response()->json([
            'user' => ['id' => $user->id, 'name' => $user->name],
        ], 201);
    }

    public function destroy(Issue $issue, User $user): JsonResponse
    {
        $issue->members()->detach($user->id);

        return response()->json(['detached' => $user->id]);
    }
}
