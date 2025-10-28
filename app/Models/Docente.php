<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Docente
 *
 * @property $id
 * @property $nombre_docente
 * @property $apellido_docente
 * @property $telefono_docente
 * @property $CI_docente
 * @property $correo_electronico_docente
 * @property $fecha_contratacion
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Docente extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre_docente', 'apellido_docente', 'telefono_docente', 'CI_docente', 'correo_electronico_docente', 'fecha_contratacion', 'estado'];

    protected static function booted()
{
    static::creating(function ($docente) {
        if (is_null($docente->fecha_contratacion)) {
            $docente->fecha_contratacion = now()->toDateString();
        }
    });
}

}
