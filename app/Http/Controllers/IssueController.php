<?php

namespace App\Http\Controllers;

use App\Enums\IssuePriority;
use App\Enums\IssueStatus;
use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IssueController extends Controller
{
    public function index(Request $request, Project $project): View|JsonResponse
    {
        $issues = $project->issues()
            ->with('tags')
            ->withCount('comments')
            ->status($request->input('status'))
            ->priority($request->input('priority'))
            ->tag($request->input('tag'))
            ->search($request->input('q'))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'html' => view('issues.list', compact('issues', 'project'))->render(),
            ]);
        }

        return view('issues.index', [
            'project' => $project,
            'issues' => $issues,
            'tags' => Tag::orderBy('name')->get(),
            'statuses' => IssueStatus::cases(),
            'priorities' => IssuePriority::cases(),
            'filters' => $request->only(['status', 'priority', 'tag', 'q']),
        ]);
    }

    public function create(Project $project): View
    {
        return view('issues.create', [
            'project' => $project,
            'issue' => new Issue(),
            'statuses' => IssueStatus::cases(),
            'priorities' => IssuePriority::cases(),
        ]);
    }

    public function store(StoreIssueRequest $request, Project $project): RedirectResponse
    {
        $issue = $project->issues()->create($request->validated());

        return redirect()
            ->route('projects.issues.show', [$project, $issue])
            ->with('status', 'Issue created.');
    }

    public function show(Project $project, Issue $issue): View
    {
        $issue->setRelation('project', $project);
        $issue->load(['tags', 'members'])->loadCount('comments');

        return view('issues.show', [
            'project' => $project,
            'issue' => $issue,
        ]);
    }

    public function edit(Project $project, Issue $issue): View
    {
        return view('issues.edit', [
            'project' => $project,
            'issue' => $issue,
            'statuses' => IssueStatus::cases(),
            'priorities' => IssuePriority::cases(),
        ]);
    }

    public function update(UpdateIssueRequest $request, Project $project, Issue $issue): RedirectResponse
    {
        $issue->update($request->validated());

        return redirect()
            ->route('projects.issues.show', [$project, $issue])
            ->with('status', 'Issue updated.');
    }

    public function destroy(Project $project, Issue $issue): RedirectResponse
    {
        $issue->delete();

        return redirect()
            ->route('projects.issues.index', $project)
            ->with('status', 'Issue deleted.')
            ->with('undo', route('issues.restore', $issue));
    }

    public function trash(Project $project): View
    {
        $issues = $project->issues()
            ->onlyTrashed()
            ->with('tags')
            ->withCount('comments')
            ->latest('deleted_at')
            ->paginate(10);

        return view('issues.trash', compact('project', 'issues'));
    }

    public function restore(Issue $issue): RedirectResponse
    {
        $issue->restore();

        return redirect()
            ->route('projects.issues.trash', $issue->project_id)
            ->with('status', 'Issue restored.');
    }

    public function forceDelete(Issue $issue): RedirectResponse
    {
        $projectId = $issue->project_id;

        $issue->forceDelete();

        return redirect()
            ->route('projects.issues.trash', $projectId)
            ->with('status', 'Issue permanently deleted.');
    }
}
