<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Nivele
 *
 * @property $id
 * @property $nombre_nivel
 * @property $edad_minima
 * @property $edad_maxima
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Nivele extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nombre_nivel', 'edad_minima', 'edad_maxima', 'estado'];


}
