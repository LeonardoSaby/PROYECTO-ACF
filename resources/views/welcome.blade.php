<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guardería ACF</title>
    <link href="https://fonts.bunny.net/css?family=quicksand:400,500,600,700" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

    <style>
        body{
            margin:0;
            font-family:'Quicksand', sans-serif;
            background:#011126; /* Base igual al login */
            min-height:100vh;
            display:flex;
            flex-direction:column;
        }

        /* Overlay más vivo */
        .overlay{
            position:fixed;
            inset:0;
            background:linear-gradient(
                to bottom right,
                rgba(3, 76, 140, 0.55),
                rgba(0, 160, 255, 0.25)
            );
            z-index:-1;
        }

        header{
            background:rgba(0, 53, 102, 0.70);
            backdrop-filter:blur(10px);
            padding:1.2rem 2rem;
            box-shadow:0 5px 20px rgba(0,0,0,0.5);
        }

        .header-content{
            max-width:1200px;
            margin:0 auto;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .logo{
            font-size:1.7rem;
            font-weight:700;
            color:#A7D3F2;
            display:flex;
            align-items:center;
            gap:0.5rem;
        }

        nav a{
            color:#C0E0F4;
            font-weight:600;
            text-decoration:none;
            padding:0.6rem 1.2rem;
            border-radius:8px;
            transition:.3s;
        }
        nav a:hover{
            background:#0353a4;
            color:white;
        }

        .container{
            max-width:900px;
            margin:0 auto;
            padding:4rem 2rem;
            text-align:center;
        }

        /* Logo centrado */
        .hero-logo img{
            height:120px;
            margin-bottom:1rem;
            filter:drop-shadow(0 0 10px rgba(0,0,0,0.6));
        }

        .hero h1{
            color:#A7D3F2;
            font-size:3rem;
            margin-bottom:1rem;
            text-shadow:0 0 10px rgba(0,0,0,0.4);
        }

        .hero p{
            color:#E1F3FF;
            font-size:1.25rem;
            max-width:700px;
            margin:0 auto 2.5rem;
            line-height:1.6;
        }

        .btn{
            display:inline-block;
            padding:1rem 2rem;
            border-radius:10px;
            background:#0466c8;
            color:white;
            font-weight:700;
            text-decoration:none;
            transition:.3s;
            font-size:1.1rem;
            box-shadow:0 0 18px rgba(0,0,0,0.3);
        }

        .btn:hover{
            background:#0353a4;
            transform:translateY(-3px);
        }
    </style>
</head>

<body>

    <div class="overlay"></div>

    <header>
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-heart" style="color:#A7D3F2;"></i>
                Guardería ACF
            </div>

            <nav>
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit"
                            style="background:none;border:none;color:#C0E0F4;cursor:pointer;font-weight:600;">
                            Salir
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Iniciar Sesión</a>
                @endauth
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="hero">

            <!-- Logo igual al del login -->
            <div class="hero-logo">
                <img src="{{ asset('images/logo_guarderia.png') }}" alt="Logo Guardería">
            </div>

            <h1>Bienvenido a Guardería ACF</h1>

            <p>
                Un espacio seguro, lleno de cariño y aprendizaje para los más pequeños.
                Cuidamos, acompañamos y guiamos el desarrollo de cada niño con responsabilidad,
                dedicación y un ambiente diseñado para su bienestar.
            </p>

            @auth
                <a href="{{ url('/dashboard') }}" class="btn">Ir al Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn">Iniciar Sesión</a>
            @endauth
        </div>
    </div>

</body>
</html>
