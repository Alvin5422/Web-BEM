<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cabinet_name',
        'leader_name',
        'vice_leader_name',
        'motto',
        'vision',
        'mission',
        'cabinet_logo',
        'is_active',
        'start_year',
        'end_year',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'start_year' => 'integer',
            'end_year' => 'integer',
        ];
    }

    public function members()
    {
        return $this->hasMany(Member::class)->orderBy('order', 'asc');
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public static function getActive(): ?self
    {
        return static::where('is_active', true)->first();
    }
}
