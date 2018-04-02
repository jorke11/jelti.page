<style>

    #search{
        background-color: rgba(255,255,255,0);border-top: none;
        border-right: none;border-left: none;border-bottom: 2px solid #fff;color: #fff;
        width: 80%
    }
    #search::placeholder{
        color:white
    }

    .title-menu{
        color: white
    }

    .title-menu:hover{
        color: white;
        font-weight: bold
    }

    .main-menu{
        padding-top: 100px;
        position: relative;
        transition: all 1s ease;
        background-repeat: no-repeat;
        background-position-y: -50px;
        background-image: url("/images/page/fondosuperior.svg")
    }
    .main-menu-out{
        padding-top: 0px;
        transition: all 1.5s ease;
        background-color: #6dcbb2 !important
    }

    .go-top {
        position: fixed;
        bottom: 4em;
        right: 2em;
        text-decoration: none;
        color: #fff;
        background-color: rgba(0, 0, 0, 0.3);
        font-size: 12px;
        padding: 1em;
        display: none;
        z-index: 1000;
        border-radius: 50% 50% 50% 50%;
    }

    .go-top:hover {
        background-color: rgba(0, 0, 0, 0.6);
        color:white;
    }
</style>

<nav class="navbar navbar-expand-lg fixed-top navbar-light main-menu img-fluid" id="main-menu-id" style="background-color: #6dcbb;width: 100%;height: auto">
    <!--<nav class="navbar navbar-expand-md fixed-top main-menu img-fluid" id="main-menu-id" style="background-image: url({{url("/images/page/fondosuperior.svg")}});width: 100%;height: auto">-->
    <!--<nav class="navbar navbar-expand-lg navbar-light" id="main-menu-id" style="background-color: #ccc">-->
    <a class="navbar-brand d-lg-none" href="#">
        <img alt="Brand" src="/images/page/logosuperf.svg" class="img-fluid" width="30%">
    </a>

    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="color:red"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarsExampleDefault" style="">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" style="font-size: 19px;padding-left: 40px;padding-right:40px">Categorias</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" style="font-size: 19;padding-right:40px">Dieta</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" style="font-size: 19;padding-right:40px">Blog</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <!--<img alt="Brand" src="{{asset('assets/images/SF50X.png') }}" />-->
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-1">
            <input class="form-control mr-sm-2 form-control-sm" type="text" placeholder="Brownie, Paleo, Quinua" aria-label="Search" style="width: 300px">
            <button class="btn btn-outline-dark my-2 my-sm-0 btn-sm" type="submit">Search</button>
        </form>

        <ul class="navbar-nav">
            @guest
            <li class="nav-item dropdown active">
                <a class="nav-link" href="{{ route('login') }}"><button class="btn btn-outline-light my-2 my-sm-0 btn-sm" type="submit">Iniciar Sesión</button></a>
            </li>
            @else
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" style="color:white;font-size: 19px;padding-left: 40px;padding-right:40px">({{ Auth::user()->name }})</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Historial Pedidos</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </div>
            </li>
            @endguest
        </ul>

    </div>
</nav>

<a class="go-top" href="#">
    <img src='{{url("images/boton-subir.png")}}'>
</a>