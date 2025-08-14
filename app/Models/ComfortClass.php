<?php

namespace App\Models;

use App\Models\Car;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComfortClass extends Model
{
    use HasFactory;

    protected $table = 'comfortclasses';

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function vacancies()
    {
        return $this->belongsToMany(Vacancy::class, 'vacancy_comfort');
    }

}
