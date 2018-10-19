@auth
<input type="hidden" id="user_id" value="{{Auth::user()->id}}">
@endauth

<nav class="navbar navbar-expand-lg fixed-top navbar-light main-menu img-fluid img-header " id="main-menu-id" >
    <a class="navbar-brand d-lg-none" href="/">
        <img alt="Brand" src="/images/page/logosuperf.svg" class="img-fluid" width="30%" alt="Logo superfuds">
    </a>

    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" 
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="color:red"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarsExampleDefault" style="">
        <ul class="navbar-nav" id="menu-header">
            <li class="nav-item dropdown active" id="menu-diet">
                <a class="nav-link dropdown-toggle title-menu" href="{{url("/")}}" id="title-categories" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" >CATEGORIAS</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    @if(isset($categories))
                    @foreach($categories as $val)
                    <a style="color:black" class="dropdown-item" href="{{url("")}}/products/{{$val->slug}}">{{ucwords(strtolower($val->description))}}</a>
                    @endforeach
                    @endif
                </div>
            </li>
            <li class="nav-item dropdown" id="menu-category">
                <a class="nav-link dropdown-toggle title-menu" href="http://example.com" id="dropdown01" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" >DIETAS</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    @if(isset($dietas))
                    @foreach($dietas as $val)
                    <a class="dropdown-item" href='{{url("search/c=".$val->slug)}}'>{{$val->description}}</a>
                    @endforeach
                    @endif
                </div>
            </li>

            @guest
            <li class="nav-item dropdown" id="menu-category">
                <a class="nav-link title-menu" href="#" aria-haspopup="true" aria-expanded="false" id="btn-register" >REGISTRATE</a>
            </li>
            @endguest
        </ul>

        <ul class="navbar-nav mr-auto text-center center-image" style="">
            <li class="nav-item">
                <a href="{{url("/")}}"><img alt="Brand" src="{{asset('images/page/logosuperf.svg') }}" id="img-logo" /></a>
            </li>
        </ul>

        <form class="form-inline  my-2 my-lg-1"  id="frmSearch">

            <div class="col-auto" id="style-input-search" >
                <label class="sr-only" for="inlineFormInputGroup">Username</label>
                <div class="input-group mb-2" style="padding-top:10px">
                    <input type="text" class="form-control form-control-sm typeahead" id="text-search" placeholder="Brownie, Paleo, Quinua" required=""  data-provide="typeahead">
                    <div class="input-group-prepend" style="cursor:pointer" id="btnSearch">
                        <div class="input-group-text" style="background-color: rgba(0,0,0,0);height: 26px" >
                            <svg id="i-search" viewBox="0 0 32 32" width="32" height="23" fill="none" stroke="white" stroke-linecap="round" 
                                 stroke-linejoin="round" stroke-width="2">
                            <circle cx="14" cy="14" r="12" />
                            <path d="M23 23 L30 30"  />
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
        </form>

        <ul class="navbar-nav">
            @guest
            <li class="nav-item dropdown active" id="init-session" >
                <a class="nav-link" href="{{ route('login') }}">
                    <button class="btn btn-outline-light my-2 my-sm-0 btn-sm" style="padding: .10rem .5rem;" type="submit">Iniciar Sesión</button>
                </a>
            </li>
            @else

            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="title-account" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" >{{substr(Auth::user()->name,0,8)}}</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/profile">Mis Datos</a>
                    <a class="dropdown-item" href="/my-orders">Historial Pedidos</a>
                    <a class="dropdown-item" href="/myFavourite">Mis favoritos</a>
                    <a class="dropdown-item" href="/coupon">Cupones</a>
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
            <li class="nav-item">
                <a class="nav-link" id="popover-card" href="#" title='Resumen Compra' role="button">
                    <img alt="Brand" src="{{asset('images/page/carrito.png') }}"  id="img-cart" />
                    <span class="badge badge-light" id="badge-quantity">0</span>
                </a>
            </li>
            @endguest
        </ul>

    </div>
</nav>

<a class="go-top" href="#">
    <img src='{{url("images/boton-subir.png")}}' alt="btn subir">
</a>

<div class="d-none" id="popover-content" >
    <div class="hide">
        <div class="container-fluid" id="popover-content" style="
             max-height: 150px;
             max-width: 310px;
             overflow-y: scroll;">

        </div>
    </div>        
</div>