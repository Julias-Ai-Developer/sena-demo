<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'title',
        'description',
        'features',
        'link_label',
        'link_url',
        'icon',
        'accent_bar',
        'icon_bg',
        'icon_color',
        'label_color',
        'link_color',
        'order_index',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'order_index' => 'integer',
    ];
}
