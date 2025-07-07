<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model
{
    use HasFactory;
    protected $table = 'workout_exercises';
    protected $primaryKey = 'workout_exercise_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'workout_id',
        'exercise_id',
        'exercise_order',
    ];

    public function workout()
    {
        return $this->belongsTo(Workout::class, 'workout_id');
    }
    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id');
    }
}
