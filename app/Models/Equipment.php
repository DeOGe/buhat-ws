<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'equipment_id');
    }
}
