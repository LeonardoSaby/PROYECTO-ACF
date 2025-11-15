<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista General de Inscritos</title>
    <style>
        /* Fuente */
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        /* Encabezado */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        header h2 {
            color: #4CAF50;
            margin: 0;
            font-size: 24px;
        }

        header img {
            width: 80px;
            height: auto;
        }

        /* Tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #a8dadc;
            color: #1d3557;
            border: 1px solid #1d3557;
        }

        td {
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f1faee;
        }

        /* Pie de página */
        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
        }

    </style>
</head>
<body>

    <header>
        <h2>Lista General de Inscritos</h2>
        <img src="{{ public_path('images/logo_guarderia.png') }}" alt="Logo Guardería">
    </header>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre Infante</th>
                <th>Apellido Infante</th>
                <th>Curso</th>
                <th>Turno</th>
                <th>Fecha de inscripción</th>
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

    <footer>
        &copy; {{ date('Y') }} Guardería. Todos los derechos reservados.
    </footer>

</body>
</html>
