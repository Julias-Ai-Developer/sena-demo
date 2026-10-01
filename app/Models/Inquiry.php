<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'parent_name',
        'parent_phone',
        'parent_email',
        'class_level',
        'boarding_status',
        'message',
        'consent',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'consent' => 'boolean',
    ];
}
