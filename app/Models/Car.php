<?php

namespace App\Models;

use App\Models\ComfortClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Car extends Model
{
    use HasFactory;

    public function comfortclass()
    {
        return $this->hasTo(ComfortClass::class);
    }

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }

}
