<?php

namespace App\Models;

use App\Http\Traits\HasCan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Choice extends Model
{
    use HasFactory;
    use HasCan;

    protected $fillable = [
        'question_id',
        'option',
        'is_correct',
        'img_path'
    ];

    protected $appends = [
        'can',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function getImgPathAttribute($value)
    {
        return asset(Storage::url($value));
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
