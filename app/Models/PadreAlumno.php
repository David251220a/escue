<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PadreAlumno extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function padre()
    {
        return $this->belongsTo(Padre::class);
    }
}
