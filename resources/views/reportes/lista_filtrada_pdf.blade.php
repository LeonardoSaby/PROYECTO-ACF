<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Asistencia</title>
    <style>
        @page { size: A4 landscape; margin: 20mm; }
        body { font-family: Arial, sans-serif; font-size: 10pt; margin: 0; }

        header {
            text-align: center;
            margin-bottom: 10px;
        }

        header h1 {
            font-size: 18pt;
            font-weight: bold;
            color: #011126; /* Azul oscuro */
            letter-spacing: 1px;
        }

        .info {
            width: 100%;
            margin-bottom: 10px;
            display: flex;
            justify-content: flex-end;
        }

        .info div {
            margin-left: 15px;
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
            padding: 3px;
            font-size: 9pt;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td.nombre {
            text-align: left;
            padding-left: 5px;
        }

        td.cuadro {
            width: 20px;
            height: 20px;
        }

        th.dia {
            width: 20px;
        }

        td.total {
            background-color: #a8dadc;
            font-weight: bold;
        }

        /* Ajuste para permitir nombres largos y que no rompan la tabla */
        td.nombre {
            max-width: 120px;
            word-wrap: break-word;
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
    <h1>LISTA DE ASISTENCIA</h1>
</header>

<div class="info">
    <div><label>Curso:</label> {{ $curso->nombre_curso ?? 'N/A' }}</div>
    <div><label>Turno:</label> {{ $turno->nombre_turno ?? 'N/A' }}</div>
    <!--<div><label>Profesor:</label> {{ $profesor ?? 'N/A' }}</div>-->
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>ALUMNO / NOMBRE</th>
            @for($d=1; $d<=15; $d++)
                <th class="dia">{{ $d }}</th>
            @endfor
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inscritos as $inscripcion)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="nombre">{{ $inscripcion->infante->nombre_infante }} {{ $inscripcion->infante->apellido_infante }}</td>
                @for($d=1; $d<=15; $d++)
                    <td class="cuadro"></td>
                @endfor
                <td class="total"></td>
            </tr>
        @endforeach

        {{-- Para asegurar al menos 30 filas aunque haya menos inscritos --}}
        @for($i = count($inscritos); $i < 14; $i++)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td class="nombre">&nbsp;</td>
                @for($d=1; $d<=15; $d++)
                    <td class="cuadro"></td>
                @endfor
                <td class="total"></td>
            </tr>
        @endfor
    </tbody>
</table>

<footer>
    &copy; {{ date('Y') }} Guardería. Todos los derechos reservados.
</footer>

</body>
</html>
