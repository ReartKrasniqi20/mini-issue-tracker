<?php

namespace Database\Seeders;

use App\Models\Issue;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    public function run(): void
    {
        $tags = Tag::all();
        $users = User::all();

        Project::all()->each(function (Project $project) use ($tags, $users) {
            Issue::factory(random_int(4, 8))
                ->for($project)
                ->create()
                ->each(function (Issue $issue) use ($tags, $users) {
                    $issue->tags()->attach(
                        $tags->random(random_int(1, 3))->pluck('id')->all()
                    );

                    $issue->members()->attach(
                        $users->random(random_int(1, 2))->pluck('id')->all()
                    );
                });
        });
    }
}
