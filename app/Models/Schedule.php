<?php

namespace App\Models;

use App\Http\Traits\HasCan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    use HasCan;

    protected $fillable = [
        'sched_code',
        'exam_id',
        'college_id',
        'start_date',
        'end_date',
        'start_time	',
        'end_time',
    ];

    protected $appends = [
        'can',
    ];

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->format('d F Y, H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return now()->parse($value)->timezone(config('app.timezone'))->format('d F Y, H:i:s');
    }
}
