<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Curso
 *
 * @property $id
 * @property $nivel_id
 * @property $sala_id

 * @property $estado
 * @property $created_at
 * @property $updated_at
 *

 * @property Nivele $nivele
 * @property Sala $sala
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Curso extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
        protected $primaryKey = 'curso_id';

    protected $fillable = ['nombre_curso', 'nivel_id', 'sala_id', 'estado'];

    // Curso.php
    public function sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function nivel()
    {
        return $this->belongsTo(Nivele::class, 'nivel_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inscripciones()
    {
        return $this->hasMany(Inscripcione::class, 'curso_id', 'curso_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    
}
