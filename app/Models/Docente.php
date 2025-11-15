<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $primaryKey = 'docente_id';
    public $timestamps = false;

    protected $fillable = [
        'nombre_docente',
        'apellido_docente',
        'CI_docente',
        'telefono_docente',
        'correo_electronico_docente',
        'fecha_contratacion',
        'curso_id',
        'user_id',
        'estado',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id', 'curso_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

