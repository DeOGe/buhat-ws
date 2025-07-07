<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $table = 'equipments';
    protected $primaryKey = 'equipment_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'name',
        'description',
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'equipment_id');
    }
}
