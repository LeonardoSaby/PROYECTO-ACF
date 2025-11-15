<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencias</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; color: #011126; }
        header { text-align: center; margin-bottom: 20px; }
        header h2 { font-size: 20px; font-weight: bold; color: #034CBC; }

        .info { margin-bottom: 15px; display: flex; justify-content: space-between; color: #023059; }
        .info p { margin: 0; font-weight: bold; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #034CBC; text-align: center; vertical-align: middle; padding: 6px; }
        th { background-color: #023059; color: #ffffff; font-weight: bold; }
        td.nombre { text-align: left; font-weight: normal; }
        tr:nth-child(even) td { background-color: #6CAFD9; }
        tr:nth-child(odd) td { background-color: #84B8D9; }

        p.empty { text-align: center; color: #034CBC; font-weight: bold; }
    </style>
</head>
<body>

<header>
    <h2>LISTA DE ASISTENCIAS</h2>
</header>

@forelse ($asistencias as $asistencia)
    <div class="info">
        <p>Fecha: {{ $asistencia->fecha }}</p>
        <p>Curso: {{ $asistencia->detalleAsistencias->first()->inscripcion->curso->nombre_curso ?? 'N/A' }}</p>
        <p>Turno: {{ $asistencia->detalleAsistencias->first()->inscripcion->turno->nombre_turno ?? 'N/A' }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre del Infante</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistencia->detalleAsistencias as $detalle)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="nombre">{{ $detalle->inscripcion->infante->nombre_infante }} {{ $detalle->inscripcion->infante->apellido_infante }}</td>
                    <td>{{ ucfirst($detalle->observacion) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@empty
    <p class="empty">No hay asistencias registradas.</p>
@endforelse

</body>
</html>
