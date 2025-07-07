<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;
    protected $table = 'workouts';
    protected $primaryKey = 'workout_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'workout_id',
        'user_id',
        'workout_date',
        'start_time',
        'end_time',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
