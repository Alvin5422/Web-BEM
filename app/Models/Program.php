<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_id',
        'department',
        'name',
        'description',
        'objective',
        'target_audience',
        'status',
        'start_date',
        'end_date',
        'person_in_charge',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_featured' => 'boolean',
        ];
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
