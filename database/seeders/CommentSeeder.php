<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Issue;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        Issue::all()->each(
            fn (Issue $issue) => Comment::factory(random_int(2, 9))->for($issue)->create()
        );
    }
}
