<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tutore
 *
 * @property $id
 * @property $nombre_tutor
 * @property $apellido_tutor
 * @property $CI_tutor
 * @property $telefono_tutor
 * @property $correo_electronico_tutor
 * @property $direccion_tutor
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tutore extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre_tutor', 'apellido_tutor', 'CI_tutor', 'telefono_tutor', 'correo_electronico_tutor', 'direccion_tutor', 'estado'];


}
