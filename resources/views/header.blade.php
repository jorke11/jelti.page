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
        padding-top: 70px;
        position: relative;
        transition: all 1s ease;
        background-repeat: no-repeat;
        background-position-y: -55px;

    }

    .img-header{
        /*background-image: url("/images/page/fondosuperior.svg")*/
        /*background-image: url("/images/header.png") ;*/
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        background-color: rgba(91,175,152,1);
        /*background-size: 100% 132%;*/
    }

    .main-menu-out{
        padding-top: 0px;
        transition: all 1.5s ease;
        background-color: rgba(91,175,152,1) !important
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

@auth
<input type="hidden" id="user_id" value="{{Auth::user()->id}}">
@endauth

<nav class="navbar navbar-expand-lg fixed-top navbar-light main-menu img-fluid img-header " id="main-menu-id" style="background-color: #6dcbb;height: auto;left:-2px">
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
                <a class="nav-link dropdown-toggle" href="{{url("/")}}" id="dropdown01" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" style="color:white;font-weight: 300" >Categorias</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    @foreach($categories as $val)
                    <a style="color:black" class="dropdown-item" href="{{url("")}}/products/{{$val->slug}}">{{ucwords(strtolower($val->description))}}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" style="color:white;font-size: 19;padding-right:40px">Dieta</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    @foreach($dietas as $val)
                    <a class="dropdown-item" href="#">{{$val->description}}</a>
                    @endforeach
                </div>
            </li>
            <!--            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" 
                               aria-haspopup="true" aria-expanded="false" style="font-size: 19;padding-right:40px">Blog</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>-->
        </ul>

        <ul class="navbar-nav mr-auto text-center" style="padding-left: 18%;padding-top: 15px">
            <li class="nav-item">
                <a href="{{url("/")}}"><img alt="Brand" src="{{asset('images/page/logosuperf.svg') }}" width="50%" /></a>
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-1"  id="frmSearch">

            <div class="col-auto" >
                <label class="sr-only" for="inlineFormInputGroup">Username</label>
                <div class="input-group mb-2" style="padding-top:10px">
                    <input type="text" class="form-control form-control-sm" id="text-search" placeholder="Brownie, Paleo, Quinua" style="width: 330px;height: 26px" required="">
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

            <!--<input class="form-control mr-sm-2 form-control-sm" type="text" placeholder="Brownie, Paleo, Quinua" aria-label="Search" style="width: 300px" id="text-search">-->
            <!--<button class="btn btn-outline-dark my-2 my-sm-0 btn-sm" type="button" id="btnSearch">Buscar</button>-->
        </form>

        <ul class="navbar-nav">
            @guest
            <li class="nav-item dropdown active">
                <a class="nav-link" href="{{ route('login') }}">
                    <button class="btn btn-outline-light my-2 my-sm-0 btn-sm" style="padding: .10rem .5rem" type="submit">Iniciar Sesión</button>
                </a>
            </li>
            @else

            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" style="color:white;font-size: 19px;padding-left: 15px;padding-right:15px;padding-top: 15px">Mi Cuenta</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/myOrders">Historial Pedidos</a>
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
                <a class="nav-link" href="#" data-toggle="popover" title="Resumen Compra" data-placement="bottom"  
                   data-popover-content="#a1" >
                    <img alt="Brand" src="{{asset('images/page/carrito.png') }}" width="45%" />
<!--                    <svg id="i-cart" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" enable-background="new 0 0 512 512" 
                         stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="color:white">
                    <path d="M6 6 L30 6 27 19 9 19 M27 23 L10 23 5 2 2 2" />
                    <circle cx="25" cy="27" r="2" />
                    <circle cx="12" cy="27" r="2" />
                    </svg>-->
                    <span class="badge badge-light" id="badge-quantity">0</span>
                </a>
            </li>
            @endguest
        </ul>

    </div>
</nav>

<a class="go-top" href="#">
    <img src='{{url("images/boton-subir.png")}}'>
</a>


<style>
    .popover-body{
        padding: 20px;
    }
</style>
<div class="d-none" id="popover-content" >
    <div class="hide">
        <div class="container-fluid" id="popover-content" style="
             max-height: 150px;
             max-width: 310px;
             overflow-y: scroll;">

        </div>
        <div class="container-fluid" >
            <div class="row">
                <div class="col-12">

                </div>
            </div>
        </div>
    </div>        
</div>
<script>
    $(function () {
        $("[data-toggle=popover]").popover({
            html: true,
            content: function () {
                var id = $(this).attr('id')
                return $('#popover-content').html();
            }
        });
    })
</script>