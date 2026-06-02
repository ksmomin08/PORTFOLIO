<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechStack extends Model
{
    protected $table = 'tech_stacks';

    protected $fillable = [
        'name',
        'category',
        'icon',
        'status',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
