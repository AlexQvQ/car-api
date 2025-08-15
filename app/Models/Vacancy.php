<?php

namespace App\Models;

use App\Models\User;
use App\Models\ComfortClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function comfortClasses()
    {
        return $this->belongsToMany(ComfortClass::class, 'vacancy_comfort');
    }

}
