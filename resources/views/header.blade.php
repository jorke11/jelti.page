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

    }
    .main-slider{
        padding-top:160px;
    }

</style>

<nav class="navbar navbar-expand-md fixed-top main-menu" id="main-menu-id" style="background-color: #6dcbb2">
    <a class="navbar-brand d-lg-none" href="#">
        <img alt="Brand" src="{{ asset('assets/images/SF50X.png') }}">
    </a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarsExampleDefault" style="">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" style="color:white;font-size: 22px;padding-left: 10px;padding-right:40px">Categorias</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" style="color:white;font-size: 22px;padding-right:40px">Dieta</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false" style="color:white;font-size: 22px;padding-right:40px">Blog</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <img alt="Brand" src="{{ asset('assets/images/SF50X.png') }}">
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-1">
            <input class="form-control mr-sm-2 form-control-sm" type="text" placeholder="Brownie, Paleo, Quinua" aria-label="Search" style="width: 300px">
            <button class="btn btn-outline-dark my-2 my-sm-0 btn-sm" type="submit">Search</button>
        </form>

        <ul class="navbar-nav">
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" 
                   aria-haspopup="true" aria-expanded="false">Mi Cuenta </a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>

    </div>
</nav>