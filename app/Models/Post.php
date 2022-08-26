<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'slug',
        'title',
        'body',
        'is_published'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function scopePublished($query, $status)
    {
        return $query->where('is_published', $status);
    }
}
