<!DOCTYPE html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body class="" style="background-color:#FFB800">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand">MyCookingApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Acasa <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">Descopera</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/descoperaretete">Retete</a>
                    <a class="dropdown-item" href="/descoperaingrediente">Ingrediente</a>
                    @if(Auth::user())
                        <a class="dropdown-item" href="/comparaingrediente">Compara ingrediente</a>
                    @endif
                </div>
            </li>

            @if(Auth::user())
                <li class="nav-item">
                    <a class="nav-link" href="/retetelemele">Retetele mele</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ingredientelemele">Ingredientele mele</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="/programulmeu">Programul meu</a>
                </li>
            @else
            @endif
            <li>
                <form class="form-inline my-2 my-lg-0" action="submitcauta" method="get">
                    @csrf
                    <input name="q" class="form-control mr-sm-2" type="text" placeholder="Cauta retete"
                           aria-label="Cauta retete">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submitcauta">Cauta</button>
                </form>
            </li>
        </ul>
        @if(Auth::user())
            <ul class="navbar-nav">



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">{{Auth::user()->username}}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="/favorite">Favorite</a>
                        @if(Auth::user()->is_admin==1)
                            <a class="dropdown-item" href="/admin">Admin</a>
                        @endif
                    </div>
                </li>




                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </li>
            </ul>

        @else
            <ul class="navbar-nav mr-0">
                <li class="nav-item">
                    <a class="nav-link" href="/register">Inregistrare</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Logare</a>
                </li>
            </ul>
        @endif

    </div>
</nav>
<br>
<br>

{{ $slot }}

<br><br>

<div class="blog-footer p-3 p-md-5 text-white bg-success text-center">
    Footer
</div>
</body>

</html>
