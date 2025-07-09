<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    protected $table = 'exercises';
    protected $primaryKey = 'exercise_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'equipment_id',
        'muscle_id',
        'video_url',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'category_id');
    }
    public function equipments()
    {
        return $this->hasMany(Equipment::class, 'equipment_id');
    }
    public function muscles()
    {
        return $this->hasMany(Muscle::class, 'muscle_id');
    }
}
