<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asistencia extends Model
{
    use HasFactory;

    // Configuración de la tabla
    protected $table = 'asistencias';
    protected $primaryKey = 'id_asistencia';
    public $incrementing = true;

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'fecha',
        'estado', // Para eliminado lógico: 'activo', 'inactivo'
    ];
    
    // Filtro global para excluir registros 'inactivos' (eliminado lógico)
    protected static function booted()
    {
        static::addGlobalScope('active', function ($builder) {
            $builder->where('estado', 'activo');
        });
    }

    /**
     * Relación con los DetalleAsistencia (Maestro tiene muchos Detalles).
     */
    public function detalleAsistencias(): HasMany
    {
        // Una Asistencia (cabecera) tiene muchos DetalleAsistencia
        return $this->hasMany(DetalleAsistencia::class, 'id_asistencia', 'id_asistencia');
    }
}
