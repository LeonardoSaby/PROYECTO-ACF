<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InfantesTutore
 *
 * @property $id
 * @property $infante_id
 * @property $tutor_id
 * @property $parentesco
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Infante $infante
 * @property Tutore $tutore
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class InfantesTutore extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['infante_id', 'tutor_id', 'parentesco', 'estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function infante()
    {
        return $this->belongsTo(\App\Models\Infante::class, 'infante_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tutore()
    {
        return $this->belongsTo(\App\Models\Tutore::class, 'tutor_id', 'id');
    }
    
}
