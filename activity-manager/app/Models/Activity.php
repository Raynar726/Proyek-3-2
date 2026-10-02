<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title',
        'code',
        'description',
        'activity_date',
        'category_id',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}