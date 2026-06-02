<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'blog_category_id',
        'title',
        'slug',
        'thumbnail',
        'content',
        'tags',
        'meta_title',
        'meta_description',
        'published_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'published_date' => 'date',
        ];
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }
}
