<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleAsistencia extends Model
{
    use HasFactory;
    
    // Configuración de la tabla
    protected $table = 'detalle_asistencias';
    protected $primaryKey = 'id_detalle_asistencia';
    public $incrementing = true;

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'id_asistencia',
        'id_inscripcion',
        // 'observaciones' ahora contiene el estado de asistencia: 'presente', 'ausente', 'justificado'
        'observaciones', 
        // ¡CORREGIDO! 'estado' es para el eliminado lógico del detalle: 'activo', 'inactivo'
        'estado',      
    ];
    
    // Filtro global para el eliminado lógico del detalle (usando 'estado')
    protected static function booted()
    {
        static::addGlobalScope('active', function ($builder) {
            $builder->where('estado', 'activo');
        });
    }

    /**
     * Relación con la Cabecera (Detalle pertenece a un Maestro).
     */
    public function asistencia(): BelongsTo
    {
        return $this->belongsTo(Asistencia::class, 'id_asistencia', 'id_asistencia');
    }

    /**
     * Relación con Inscripcione para obtener datos del Infante, Curso y Turno.
     * * NOTA IMPORTANTE: Asume que tienes un modelo llamado 'Inscripcione'
     * con la clave primaria 'id_inscripcion'.
     */
    public function inscripcion(): BelongsTo
    {
        return $this->belongsTo(Inscripcione::class, 'id_inscripcion', 'id_inscripcion');
    }
}
