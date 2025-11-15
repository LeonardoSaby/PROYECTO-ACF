<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDetalleAsistenciaRequest;
use App\Models\DetalleAsistencia;
use Illuminate\Http\Request;

class DetalleAsistenciaController extends Controller
{
    public function update(StoreDetalleAsistenciaRequest $request, DetalleAsistencia $detalle)
    {
        $detalle->update(['observacion' => $request->observacion]);
        return redirect()->back()->with('success', 'Observación actualizada correctamente.');
    }

    // --- Actualiza varias observaciones de una sola vez ---
    public function bulkUpdate(Request $request)
    {
        $datos = $request->input('detalles', []); // array: detalle_asistencia_id => observacion

        foreach ($datos as $detalle_asistencia_id => $observacion) {
            DetalleAsistencia::where('detalle_asistencia_id', $detalle_asistencia_id)
                ->update(['observacion' => $observacion]);
        }

        return redirect()->back()->with('success', 'Observaciones actualizadas correctamente.');
    }
}
