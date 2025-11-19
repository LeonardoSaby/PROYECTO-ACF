<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Asistencias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 25px;
        }

        /* ===========================
           ENCABEZADO
        ============================ */
        .header {
            border-bottom: 2px solid #4e73df;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .logo {
            width: 70px;
            margin-right: 20px;
        }

        .title-container {
            flex: 1;
            text-align: center;
        }

        .header-title {
            font-size: 22px;
            font-weight: bold;
            color: #4e73df;
            margin: 0;
        }

        .subtitle {
            font-size: 13px;
            color: #555;
            margin-top: 3px;
        }

        .info {
            margin-bottom: 12px;
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            color: #023059;
        }

        /* ===========================
            TABLA
        ============================ */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #4e73df;
            color: white;
            padding: 8px;
            border: 1px solid #4e73df;
            font-size: 13px;
        }

        td {
            border: 1px solid #ccc;
            padding: 7px;
        }

        td.nombre {
            text-align: left;
        }

        tr:nth-child(even) td {
            background: #f8f9fc;
        }

        tr:nth-child(odd) td {
            background: #e2e6ea;
        }

        /* ===========================
            FOOTER
        ============================ */
        footer {
            text-align: center;
            font-size: 10px;
            color: #888;
            margin-top: 25px;
        }
    </style>
</head>
<body>

    <!-- ENCABEZADO -->
    <div class="header">
        <img class="logo" src="{{ public_path('images/logo_guarderia.png') }}" alt="Logo">
        <div class="title-container">
            <div class="header-title">Lista de Asistencias</div>
        </div>
    </div>

    @forelse ($asistencias as $asistencia)
        <div class="info">
            <span>Fecha: {{ $asistencia->fecha }}</span>
            <span>Curso: {{ $asistencia->detalleAsistencias->first()->inscripcion->curso->nombre_curso ?? 'N/A' }}</span>
            <span>Turno: {{ $asistencia->detalleAsistencias->first()->inscripcion->turno->nombre_turno ?? 'N/A' }}</span>
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
        <p style="text-align:center; font-weight:bold; color:#4e73df;">No hay asistencias registradas.</p>
    @endforelse

    <footer>
        © {{ date('Y') }} Guardería — Reporte generado automáticamente.
    </footer>

</body>
</html>
