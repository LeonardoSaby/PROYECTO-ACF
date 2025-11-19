<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Infante
 *
 * @property $id
 * @property $nombre_infante
 * @property $apellido_infante
 * @property $CI_infante
 * @property $fecha_nacimiento_infante
 * @property $edad_infante
 * @property $genero_infante
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Infante extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'infante_id';

    protected $fillable = ['nombre_infante', 'apellido_infante', 'CI_infante', 'fecha_nacimiento_infante', 'edad_infante', 'genero_infante', 'estado'];

    public function inscripciones()
    {
        return $this->hasMany(\App\Models\Inscripcione::class, 'infante_id');
    }
    public function tutores()
    {
        return $this->belongsToMany(Tutore::class, 'infantes_tutores', 'infante_id', 'tutor_id')
                    ->withPivot('parentesco', 'estado')
                    ->withTimestamps();
    }

    public function detalleAsistencias()
    {
        return $this->hasManyThrough(
            DetalleAsistencia::class,
            Inscripcione::class,
            'infante_id',       // FK de inscripciones a infante
            'inscripcion_id',   // FK de detalle_asistencias a inscripciones
            'infante_id',       // Local key en infante
            'inscripcion_id'    // Local key en inscripciones
        );
    }






}
