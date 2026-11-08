<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_code',
        'name',
        'is_anonymous',
        'nim',
        'study_program',
        'email',
        'phone',
        'topic',
        'subject',
        'content',
        'attachment',
        'status',
        'admin_notes',
        'response',
        'responded_at',
    ];

    protected function casts(): array
    {
        return [
            'is_anonymous' => 'boolean',
            'responded_at' => 'datetime',
        ];
    }
}
