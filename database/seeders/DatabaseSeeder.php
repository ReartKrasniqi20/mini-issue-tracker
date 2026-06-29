<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $users = collect([
            ['name' => 'Test User', 'email' => 'test@example.com'],
            ['name' => 'Alex Doe', 'email' => 'alex@example.com'],
            ['name' => 'Sam Roe', 'email' => 'sam@example.com'],
        ])->map(fn (array $data) => User::factory()->create($data));

        $tags = collect([
            ['name' => 'bug', 'color' => '#ef4444'],
            ['name' => 'feature', 'color' => '#3b82f6'],
            ['name' => 'urgent', 'color' => '#f97316'],
            ['name' => 'enhancement', 'color' => '#22c55e'],
            ['name' => 'backend', 'color' => '#8b5cf6'],
            ['name' => 'frontend', 'color' => '#ec4899'],
            ['name' => 'documentation', 'color' => '#06b6d4'],
        ])->map(fn (array $data) => Tag::create($data));

        Project::factory(6)
            ->recycle($users)
            ->create()
            ->each(function (Project $project) use ($users, $tags) {
                Issue::factory(random_int(4, 8))
                    ->for($project)
                    ->create()
                    ->each(function (Issue $issue) use ($users, $tags) {
                        $issue->tags()->attach(
                            $tags->random(random_int(1, 3))->pluck('id')->all()
                        );

                        $issue->members()->attach(
                            $users->random(random_int(1, 2))->pluck('id')->all()
                        );

                        Comment::factory(random_int(2, 6))->for($issue)->create();
                    });
            });
    }
}
