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
    protected $primaryKey = 'tutor_id';

    protected $fillable = ['nombre_tutor', 'apellido_tutor', 'CI_tutor', 'telefono_tutor', 'correo_electronico_tutor', 'direccion_tutor', 'user_id', 'estado'];

    public function infantes()
{
    return $this->belongsToMany(Infante::class, 'infantes_tutores', 'tutor_id', 'infante_id')
                ->withPivot('parentesco')
                ->wherePivot('estado', 'activo');
}



    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
