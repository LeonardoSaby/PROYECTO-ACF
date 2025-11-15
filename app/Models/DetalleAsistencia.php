<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleAsistencia extends Model
{
    use HasFactory;

    protected $primaryKey = 'detalle_asistencia_id';
    protected $fillable = ['asistencia_id', 'inscripcion_id', 'observacion'];

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class, 'asistencia_id', 'asistencia_id');
    }

    public function inscripcion()
    {
        return $this->belongsTo(Inscripcione::class, 'inscripcion_id', 'inscripcion_id');
    }
}

