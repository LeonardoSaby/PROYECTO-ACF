<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Turno
 *
 * @property $id
 * @property $nombre_turno
 * @property $hora_inicio
 * @property $hora_fin
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Turno extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
        protected $primaryKey = 'turno_id';

    protected $fillable = ['nombre_turno', 'hora_inicio', 'hora_fin', 'estado'];


}
