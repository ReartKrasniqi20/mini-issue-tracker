<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IssueTagController extends Controller
{
    public function store(Request $request, Issue $issue): JsonResponse
    {
        $data = $request->validate([
            'tag_id' => ['required', 'integer', 'exists:tags,id'],
        ]);

        $issue->tags()->syncWithoutDetaching([$data['tag_id']]);

        $tag = Tag::find($data['tag_id']);

        return response()->json([
            'tag' => ['id' => $tag->id, 'name' => $tag->name, 'color' => $tag->color],
        ], 201);
    }

    public function destroy(Issue $issue, Tag $tag): JsonResponse
    {
        $issue->tags()->detach($tag->id);

        return response()->json(['detached' => $tag->id]);
    }
}
