<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(): View
    {
        $tags = Tag::withCount('issues')->orderBy('name')->paginate(10);

        return view('tags.index', compact('tags'));
    }

    public function options(): JsonResponse
    {
        return response()->json([
            'tags' => Tag::query()
                ->select(['id', 'name', 'color'])
                ->orderBy('name')
                ->get(),
        ]);
    }

    public function store(StoreTagRequest $request): RedirectResponse
    {
        Tag::create($request->validated());

        return redirect()
            ->route('tags.index')
            ->with('status', 'Tag created.');
    }
}
