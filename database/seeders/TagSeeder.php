<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            ['name' => 'bug', 'color' => '#ef4444'],
            ['name' => 'feature', 'color' => '#3b82f6'],
            ['name' => 'urgent', 'color' => '#f97316'],
            ['name' => 'enhancement', 'color' => '#22c55e'],
            ['name' => 'backend', 'color' => '#8b5cf6'],
            ['name' => 'frontend', 'color' => '#ec4899'],
            ['name' => 'documentation', 'color' => '#06b6d4'],
            ['name' => 'testing', 'color' => '#14b8a6'],
            ['name' => 'security', 'color' => '#dc2626'],
            ['name' => 'performance', 'color' => '#f59e0b'],
            ['name' => 'design', 'color' => '#a855f7'],
            ['name' => 'api', 'color' => '#0ea5e9'],
            ['name' => 'database', 'color' => '#64748b'],
            ['name' => 'mobile', 'color' => '#d946ef'],
        ])->each(fn (array $data) => Tag::firstOrCreate(
            ['name' => $data['name']],
            ['color' => $data['color']],
        ));
    }
}
