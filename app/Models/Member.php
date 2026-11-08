<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_id',
        'name',
        'nim',
        'role_title',
        'department',
        'photo',
        'bio',
        'instagram',
        'linkedin',
        'order',
    ];

    protected function casts(): array
    {
        return [
            'order' => 'integer',
        ];
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
