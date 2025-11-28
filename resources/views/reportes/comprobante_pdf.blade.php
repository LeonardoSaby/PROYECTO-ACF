<head>
    <meta charset="utf-8">
    <title>Comprobante de Inscripción</title>
    <!-- Fuente de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        /* ENCABEZADO */
        .header {
            border-bottom: 2px solid #4e73df;
            padding-bottom: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .logo {
            width: 70px;
            margin-right: 15px;
        }

        .title-container {
            flex: 1;
            text-align: center;
        }

        /* Cambiamos la fuente del título */
        .header-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: #4e73df;
            margin: 0;
        }

        .subtitle {
            font-size: 13px;
            color: #555;
            margin-top: 3px;
        }

        /* SECCIONES */
        .section-container {
            width: 90%;
            margin: 0 auto 15px auto;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #4e73df;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 6px;
            vertical-align: top;
            border: 1px solid #ccc;
        }

        tr:nth-child(even) {
            background: #f8f9fc;
        }

        /* FIRMAS */
        .firma-box {
            margin-top: 40px;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
        }

        .firma-box td {
            border: none;
            padding-top: 30px;
            text-align: center;
        }

        .firma-line {
            margin-top: 50px;
            border-top: 1px solid #333;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        /* CONFIRMACIÓN */
        .confirmation {
            text-align: center;
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>

<body>

    <!-- ENCABEZADO -->
    <div class="header">
        <img class="logo" src="{{ public_path('images/logo_guarderia.png') }}" alt="Logo">
        <div class="title-container">
            <div class="header-title">COMPROBANTE DE INSCRIPCIÓN</div>
            <div class="subtitle">Guardería ACF</div>
        </div>
    </div>

    <!-- FECHA -->
    <div class="section-container" style="text-align:right;">
        <strong>Fecha de emisión:</strong> {{ \Carbon\Carbon::parse($inscripcion->created_at)->format('d/m/Y') }}
    </div>

    <!-- DATOS DEL INFANTE -->
    <div class="section-container">
        <div class="section-title">1. Datos del Infante</div>
        <table>
            <tr>
                <td><strong>Nombre y Apellido:</strong> {{ $infante->nombre_infante . ' ' . $infante->apellido_infante }}</td>
            </tr>
            <tr>
                <td><strong>Fecha de Nacimiento:</strong> {{ $infante->fecha_nacimiento_infante }}</td>
            </tr>
            <tr>
                <td><strong>CI:</strong> {{ $infante->CI_infante }}</td>
            </tr>
            <tr>
                <td><strong>Curso:</strong> {{ $curso->nombre_curso }}</td>
            </tr>
            <tr>
                <td><strong>Turno:</strong> {{ $turno->nombre_turno }}</td>
            </tr>
        </table>
    </div>

    <!-- DATOS DE LOS TUTORES -->
    <div class="section-container">
        <div class="section-title">2. Datos del Tutor(es)</div>
        <table>
            @foreach($tutores as $tutor)
            <tr><td><strong>Nombre:</strong> {{ $tutor->nombre_tutor }}</td></tr>
            <tr><td><strong>C.I.:</strong> {{ $tutor->CI_tutor }}</td></tr>
            <tr><td><strong>Teléfono:</strong> {{ $tutor->telefono_tutor }}</td></tr>
            <tr><td><strong>Dirección:</strong> {{ $tutor->direccion_tutor }}</td></tr>
            <tr><td>&nbsp;</td></tr>
            @endforeach
        </table>
    </div>

    <!-- CONFIRMACIÓN -->
    <div class="section-container confirmation">
        Se certifica que el infante ha sido inscrito correctamente para el período correspondiente.
    </div>

    <!-- FIRMAS -->
    <div class="firma-box">
        <table>
            <tr>
                <td>
                    <div class="firma-line"></div>
                    <small>Firma del Tutor</small>
                </td>
                <td>
                    <div class="firma-line"></div>
                    <small>Firma y Sello de la Guardería</small>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
