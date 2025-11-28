<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Asistencia</title>
    <style>
        @page { size: A4 landscape; margin: 20mm; }
        body { font-family: Arial, sans-serif; font-size: 10pt; margin: 0; }

        header {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 10px;
        }

        header img {
            position: absolute;
            left: 0;
            height: 55px;
        }

        header h1 {
            font-size: 18pt;
            font-weight: bold;
            color: #011126;
            letter-spacing: 1px;
            text-align: center;
            width: 100%;
        }

        .info {
            width: 100%;
            margin-bottom: 10px;
            display: flex;
            justify-content: flex-end;
            gap: 20px;
        }

        .info div {
            text-align: left;
            font-size: 10pt;
        }

        .info label {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #023059;
            text-align: center;
            vertical-align: middle;
            padding: 4px;
            font-size: 9pt;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td.nombre {
            text-align: left;
            padding-left: 5px;
            max-width: 200px;
            word-wrap: break-word;
        }

        td.cuadro {
            height: 25px;
        }

        footer {
            margin-top: 15px;
            text-align: center;
            font-size: 8pt;
            color: #999;
        }
    </style>
</head>
<body>

<header>
    <img class="logo" src="{{ public_path('images/logo_guarderia.png') }}" alt="Logo">
    <h1>LISTA DE ASISTENCIA</h1>
</header>

<div class="info">
    <div><label>Curso:</label> {{ $curso->nombre_curso ?? 'N/A' }}</div>
    <div><label>Turno:</label> {{ $turno->nombre_turno ?? 'N/A' }}</div>
</div>

<table>
    <thead>
        <tr>
            <th>NOMBRE Y APELLIDO</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inscritos as $inscripcion)
            <tr>
                <td class="nombre">{{ $inscripcion->infante->nombre_infante }} {{ $inscripcion->infante->apellido_infante }}</td>
                <td class="cuadro"></td>
                <td class="cuadro"></td>
                <td class="cuadro"></td>
                <td class="cuadro"></td>
                <td class="cuadro"></td>
            </tr>
        @endforeach
    </tbody>
</table>

<footer>
    &copy; {{ date('Y') }} Guardería. Todos los derechos reservados.
</footer>

</body>
</html>
