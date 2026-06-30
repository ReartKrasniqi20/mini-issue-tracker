<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Issue;
use Illuminate\Http\JsonResponse;

class IssueCommentController extends Controller
{
    public function index(Issue $issue): JsonResponse
    {
        $comments = $issue->comments()->latest()->paginate(5);

        $html = $comments
            ->map(fn (Comment $comment) => view('comments.comment', compact('comment'))->render())
            ->implode('');

        return response()->json([
            'html' => $html,
            'next_page' => $comments->hasMorePages() ? $comments->currentPage() + 1 : null,
            'total' => $comments->total(),
        ]);
    }

    public function store(StoreCommentRequest $request, Issue $issue): JsonResponse
    {
        $comment = $issue->comments()->create($request->validated());

        return response()->json([
            'html' => view('comments.comment', compact('comment'))->render(),
            'total' => $issue->comments()->count(),
        ], 201);
    }
}
