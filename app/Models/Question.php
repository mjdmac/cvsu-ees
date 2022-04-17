<?php

namespace App\Models;

use App\Http\Traits\HasCan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    use HasCan;

    protected $fillable = [
        'exam_id',
        'question',
    ];

    protected $appends = [
        'can',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function choices(){
        return $this->hasMany(Choice::class);
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
