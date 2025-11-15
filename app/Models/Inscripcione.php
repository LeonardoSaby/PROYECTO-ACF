<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcione extends Model
{
    use HasFactory;

    protected $primaryKey = 'inscripcion_id';

    protected $table = 'inscripciones'; // ajusta si tu tabla tiene otro nombre

    protected $fillable = ['infante_id', 'curso_id', 'turno_id', 'fecha'];


    public function infante() {
        return $this->belongsTo(Infante::class, 'infante_id', 'infante_id');
    }

    public function curso() {
        return $this->belongsTo(Curso::class, 'curso_id', 'curso_id');
    }

    public function turno() {
        return $this->belongsTo(Turno::class, 'turno_id', 'turno_id');
    }

}
