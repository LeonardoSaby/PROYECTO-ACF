<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista General de Inscritos</title>

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

        /* ===========================
            TABLA
        ============================ */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
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

        tr:nth-child(even) {
            background: #f8f9fc;
        }

        tr:hover {
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

        <!-- Logo izquierda -->
        <img class="logo" src="{{ public_path('images/logo_guarderia.png') }}" alt="Logo">

        <!-- Título centrado -->
        <div class="title-container">
            <div class="header-title">Lista General de Inscritos</div>
        </div>

    </div>

    <!-- TABLA -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Infante</th>
                <th>Apellidos</th>
                <th>Curso</th>
                <th>Turno</th>
                <th>Fecha Inscripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inscritos as $inscripcion)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $inscripcion->infante->nombre_infante }}</td>
                <td>{{ $inscripcion->infante->apellido_infante }}</td>
                <td>{{ $inscripcion->curso->nombre_curso ?? 'N/A' }}</td>
                <td>{{ $inscripcion->turno->nombre_turno ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($inscripcion->fecha)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- FOOTER -->
    <footer>
        © {{ date('Y') }} Guardería — Reporte generado automáticamente.
    </footer>

</body>
</html>
