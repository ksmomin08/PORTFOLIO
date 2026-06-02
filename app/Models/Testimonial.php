<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'client_name',
        'company',
        'review_text',
        'profile_photo',
        'rating',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'rating' => 'integer',
        ];
    }
}
