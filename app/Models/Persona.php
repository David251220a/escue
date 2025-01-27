<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function alumno()
    {
        return $this->hasOne(Alumno::class);
    }

    public function padre()
    {
        return $this->hasOne(Padre::class);
    }
}
