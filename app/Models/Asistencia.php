<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencias';

        protected $primaryKey = 'asistencia_id';

    protected $fillable = [
        'fecha',
        'estado',
    ];

    public function detalleAsistencias()
    {
        return $this->hasMany(DetalleAsistencia::class, 'asistencia_id');
    }
}
