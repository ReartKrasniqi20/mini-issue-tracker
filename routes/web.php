<?php

use App\Http\Controllers\IssueCommentController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\IssueMemberController;
use App\Http\Controllers\IssueTagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
    Route::patch('projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.restore')->withTrashed();
    Route::delete('projects/{project}/force', [ProjectController::class, 'forceDelete'])->name('projects.force')->withTrashed();

    Route::get('projects/{project}/issues/trash', [IssueController::class, 'trash'])->name('projects.issues.trash');
    Route::patch('issues/{issue}/restore', [IssueController::class, 'restore'])->name('issues.restore')->withTrashed();
    Route::delete('issues/{issue}/force', [IssueController::class, 'forceDelete'])->name('issues.force')->withTrashed();

    Route::resource('projects', ProjectController::class);
    Route::resource('projects.issues', IssueController::class)->scoped();

    Route::get('tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('tags/options', [TagController::class, 'options'])->name('tags.options');
    Route::post('tags', [TagController::class, 'store'])->name('tags.store');

    Route::get('users/options', [UserController::class, 'options'])->name('users.options');

    Route::post('issues/{issue}/tags', [IssueTagController::class, 'store'])->name('issues.tags.store');
    Route::delete('issues/{issue}/tags/{tag}', [IssueTagController::class, 'destroy'])->name('issues.tags.destroy');

    Route::get('issues/{issue}/comments', [IssueCommentController::class, 'index'])->name('issues.comments.index');
    Route::post('issues/{issue}/comments', [IssueCommentController::class, 'store'])->name('issues.comments.store');

    Route::post('issues/{issue}/members', [IssueMemberController::class, 'store'])->name('issues.members.store');
    Route::delete('issues/{issue}/members/{user}', [IssueMemberController::class, 'destroy'])->name('issues.members.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
