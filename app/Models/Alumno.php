<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function persona()
    {
        return $this->hasOne(Persona::class, 'id', 'persona_id');
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class);
    }
}
