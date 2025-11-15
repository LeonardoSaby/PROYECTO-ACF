<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sala
 *
 * @property $id
 * @property $nombre_sala
 * @property $capacidad_maxima
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sala extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
        protected $primaryKey = 'sala_id';

    protected $fillable = ['nombre_sala', 'capacidad_maxima', 'estado'];


}
