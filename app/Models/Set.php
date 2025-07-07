<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;
    protected $table = 'sets';
    protected $primaryKey = 'set_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'workout_exercise_id',
        'set_number',
        'reps',
        'weight',
        'time',
        'distance',
        'notes',
    ];

    public function workoutExercise()
    {
        return $this->belongsTo(WorkoutExercise::class, 'workout_exercise_id');
    }
}
