<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Guardería ABC - Gestión Integral</title>
        <link href="https://fonts.bunny.net/css?family=quicksand:400,500,600,700" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

        <style>
            *{
                margin:0;
                padding:0;
                box-sizing:border-box;
            }

            body{
                font-family:'Quicksand', sans-serif;
                background: linear-gradient(135deg,#0a2540,#0e4a73);
                min-height:100vh;
                display:flex;
                flex-direction:column;
            }

            header{
                background:rgba(20,20,20,0.8);
                backdrop-filter:blur(10px);
                padding:1.5rem 2rem;
                box-shadow:0 5px 20px rgba(0,0,0,0.4);
                position:sticky;
                top:0;
                z-index:100;
            }

            .header-content{
                max-width:1200px;
                margin:0 auto;
                display:flex;
                justify-content:space-between;
                align-items:center;
            }

            .logo{
                font-size:1.8rem;
                font-weight:700;
                color:#b6d4ff;
                display:flex;
                align-items:center;
                gap:0.5rem;
            }

            nav a{
                text-decoration:none;
                color:#e2e8f0;
                font-weight:600;
                padding:0.7rem 1.5rem;
                border-radius:25px;
                transition:all .3s;
                margin:0 0.5rem;
            }

            nav a:hover{
                background:#1e3a56;
                color:white;
            }

            .container{
                max-width:1200px;
                margin:0 auto;
                padding:3rem 2rem;
                flex:1;
            }

            .hero{
                text-align:center;
                color:white;
                margin-bottom:3rem;
            }

            .hero h1{
                font-size:3.5rem;
                margin-bottom:1rem;
                font-weight:700;
                text-shadow:2px 2px 4px rgba(0,0,0,0.4);
            }

            .btn-group{
                display:flex;
                gap:1rem;
                justify-content:center;
                flex-wrap:wrap;
            }

            .btn{
                padding:1rem 2rem;
                border-radius:30px;
                border:none;
                font-weight:600;
                font-size:1.1rem;
                cursor:pointer;
                transition:all .3s;
                text-decoration:none;
                display:inline-block;
            }

            .btn-primary{
                background:#1d70b8;
                color:white;
                box-shadow:0 10px 30px rgba(0,0,0,0.3);
            }

            .btn-primary:hover{
                background:#145a96;
                transform:translateY(-2px);
            }

            @media(max-width:768px){
                .hero h1{
                    font-size:2rem;
                }
                .btn-group{
                    flex-direction:column;
                    align-items:center;
                }
                .btn{
                    width:100%;
                    max-width:400px;
                }
            }
        </style>

    </head>

    <body>
        <header>
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-heart" style="color:#ff6b6b;"></i>
                    Guardería ACF
                </div>

                <nav>
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit"
                                style="background:none;border:none;cursor:pointer;font-size:1rem;font-weight:600;color:#e2e8f0;padding:0.7rem 1.5rem;">
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
                <h1>Bienvenido a Guardería ACF</h1>
                <p></p>

                <div class="btn-group">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Ir al Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
                    @endauth
                </div>
            </div>
        </div>
    </body>
</html>
