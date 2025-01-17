<?php

namespace App\Models;

use App\Http\Traits\HasCan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Applicant extends Model
{
    use HasFactory;
    use HasCan;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'applicants', 'length' => 10, 'prefix' => date('ym'), 'reset_on_prefix_change' => true]);
        });
    }

    protected $fillable = [
        'user_id',
        'fname',
        'mname',
        'lname',
        'birthday',
        'email',
        'phone_number',
    ];

    protected $appends = [
        'can',
    ];

    public function userAccount()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function colleges()
    {
        return $this->belongsToMany(College::class, 'applicant_college');
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
