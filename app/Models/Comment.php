<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['issue_id', 'author_name', 'body'])]
class Comment extends Model
{
    use HasFactory;

    public function issue(): BelongsTo
    {
        return $this->belongsTo(Issue::class);
    }
}
