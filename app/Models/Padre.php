<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padre extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function hijos()
    {
        return $this->hasMany(PadreAlumno::class)->where('estado_id', 1);
    }

    public function persona()
    {
        return $this->hasOne(Persona::class, 'id', 'persona_id');
    }
}
