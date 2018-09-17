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
        color: white !important;
        font-size: 21px
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



    #text-search{
        width: 320px;
        height: 26px
    }



    #img-image{
        width:70%
    }

    .center-image{
        padding-left: 22%;padding-top: 15px;padding-bottom: 2%   
    }

    .btn-plus{
        width: 20px;
        height: 20px;
        color:#ffffff;
        fill:#ffffff;
    }
    .btn-minus{
        width: 20px;
        height: 20px;
        color:#ffffff;
        fill:#ffffff;
    }

    .icon-social {
        position: absolute;
        top: 0.1em;
        /*right: 90%;*/
        right: 20px;
        text-decoration: none;
        text-align: right;
        color: #fff;
        padding-top: 0.1em;
        z-index: 2000;
    }

    .img-social {
        width: 50%
    }
    #init-session{
        padding-right: 72%
    }

    #slider-main{
        position:relative;
        top: -66px   
    }

    #title-account{
        color:white;
        font-size: 19px;
        padding-left: 15px;
        padding-right:15px;
        padding-top: 15px    
    }

    #img-cart{
        width:45%
    }

    .title-diet{
        font-family: "dosis" !important
    }

    .link-white{
        color:white !important;
        font-size: 15px
    }




    @media screen and (max-width: 1500px) {

        #text-search{
            width: 220px;
            height: 26px
        }

        #img-menu{

        }

        .center-image{
            padding-left: 19%;
            padding-top: 15px;padding-bottom: 2%   
        }

        #init-session{
            padding-right:130px
        }

        #slider-main{
            position:relative;top: -45px;
        }
    }

    @media screen and (max-width: 1400px) {
        #text-search{
            width: 200px;
            height: 26px
        }

        #init-session{
            padding-right: 50%
        }

        .center-image{
            padding-left: 22%;padding-top: 15px;padding-bottom: 2%   
        }
    }


    @media screen and (max-width: 1300px) {
        #text-search{
            width: 240px;
            height: 26px
        }

        .center-image{
            padding-left: 20%;padding-top: 15px;padding-bottom: 2%   
        }

        #img-menu{
            display: none;
        }

        #init-session{
            padding-right: 0
        }
        #title-account{
            font-size: 16px
        }
        #img-cart{
            width:35%
        }

        #text-search{
            width: 180px;
            height: 26px
        }
    }


    @media screen and (max-width: 1200px) {
        .center-image{
            padding-left: 23%;padding-top: 15px;padding-bottom: 2%   
        }
        #text-search{
            width: 140px;
            height: 26px
        }
        #title-account{
            font-size: 14px
        }

        .title-menu{
            color:white;
            font-size: 16px
        }

        #style-input-search{
            padding-left: 0px;
            padding-right: 0px
        }

    }

    @media screen and (max-width: 1100px) {
        .title-diet{
            font-size: 25px;
        }
        .link-white{
            font-size: 14px;
        }
    }








</style>

<div class="icon-social d-none d-lg-block pt-10"  style="padding-top:1%">
    <div class="row row-space justify-content-center ">
        <div class="col-lg-2 col-4 pr-0 pl-0">
            <a href="https://www.facebook.com/superfuds/" target="_blank">
                <img src="/images/page/facebook.svg" class="img-fluid img-social">
            </a>
        </div>
        <div class="col-lg-2 col-4 pr-0 pl-0">
            <a href="https://www.instagram.com/superfuds/?hl=es-la" target="_blank"><img src="/images/page/instagram.svg" class="img-fluid img-social"></a>
        </div>
        <div class="col-lg-2 col-4 pr-0 pl-0">
            <a href="https://www.youtube.com/channel/UC4YzleJ0zrgAGHwhV74R_GA/featured" target="_blank"><img src="/images/page/youtube.svg" class="img-fluid img-social"></a>
        </div>
        <div class="col-lg-2 col-4 pr-0 pl-0">
            <a href="https://co.pinterest.com/superfuds/" target="_blank"><img src="/images/page/pinterest.svg" class="img-fluid img-social" ></a>
        </div>
        <div class="col-lg-2  col-4 pr-0 pl-0">
            <a href="https://plus.google.com/112289524335507891140" target="_blank"><img src="/images/page/google.svg" class="img-fluid img-social"></a>
        </div>
    </div>
</div>

@auth
<input type="hidden" id="user_id" value="{{Auth::user()->id}}">
@endauth

<nav class="navbar navbar-expand-lg fixed-top navbar-light main-menu img-fluid img-header " id="main-menu-id" style="height: 150px;padding-bottom:3%">
    <a class="navbar-brand d-lg-none" href="/">
        <img alt="Brand" src="/images/page/logosuperf.svg" class="img-fluid" width="30%">
    </a>

    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" 
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="color:red"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarsExampleDefault" style="">
        <ul class="navbar-nav mr-auto" id="menu-header">
            <li class="nav-item dropdown active" id="menu-diet">
                <a class="nav-link dropdown-toggle title-menu" href="{{url("/")}}" id="title-categories" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" >CATEGORIAS</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    @foreach($categories as $val)
                    <a style="color:black" class="dropdown-item" href="{{url("")}}/products/{{$val->slug}}">{{ucwords(strtolower($val->description))}}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown" id="menu-category">
                <a class="nav-link dropdown-toggle title-menu" href="http://example.com" id="dropdown01" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" >DIETAS</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    @foreach($dietas as $val)
                    <a class="dropdown-item" href='{{url("search/s=".$val->slug)}}'>{{$val->description}}</a>
                    @endforeach
                </div>
            </li>
        </ul>

        <ul class="navbar-nav mr-auto text-center center-image" style="">
            <li class="nav-item">
                <a href="{{url("/")}}"><img alt="Brand" src="{{asset('images/page/logosuperf.svg') }}" id="img-image" /></a>
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
                   aria-haspopup="true" aria-expanded="false" >Mi Cuenta</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/myOrders">Historial Pedidos</a>
                    <a class="dropdown-item" href="/myFavourite">Mis favoritos</a>
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
    <img src='{{url("images/boton-subir.png")}}'>
</a>

<style>
    .popover-body{
        padding: 20px;
        overflow-y: scroll;
        height: 550px
    }
    .popover{
        max-width: 380px;
    }
</style>
<div class="d-none" id="popover-content" >
    <div class="hide">
        <div class="container-fluid" id="popover-content" style="
             max-height: 150px;
             max-width: 310px;
             overflow-y: scroll;">

        </div>
    </div>        
</div>