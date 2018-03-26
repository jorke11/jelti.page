<style>
    #categories-footer.list-group-item {
        background-color: #6dcbb2;
    }
</style>
<div class="container-fluid">
    <!--<div class="row" style="background-color: rgba(0,0,0,.8);">-->
    <div class="row" style="background-color:#6dcbb2;">
        <div class="col-5" style="padding-top: 2%;padding-bottom: 2%">
            <div class="row">
                <div class="col-4">
                    <ul class="list-group" id="categories-footer">
                        <li class="list-group-item">CATEGORIAS</li>
                        @foreach($category as $val)
                        <li class="list-group-item">{{$val->description}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-4">
                    <ul class="list-group">
                        <li class="list-group-item">DIETAS</li>
                        @foreach($category as $val)
                        <li class="list-group-item">{{$val->description}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-4">
                    <ul class="list-group">
                        <li class="list-group-item">SF</li>
                        @foreach($category as $val)
                        <li class="list-group-item">{{$val->description}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-2 text-center" style="padding-top: 2%;">
            <img src="{{ asset('assets/images/SF50X.png') }}" class="img-responsive">
        </div>
        <div class="col-5" style="padding-top: 2%;">
            <div class="row row-space">
                <div class="col-12 text-center">
                    <h2 class="white-label">Siguenos</h2>
                </div>
            </div>
            <div class="row row-space">
                <div class="col-2 offset-1">
                    <a href="https://www.facebook.com/superfuds/" target="_blank"><p class="text-center"><img src="/images/facebook.png" class="img-responsive"></p></a>
                </div>
                <div class="col-2">
                    <a href="https://www.instagram.com/superfuds/?hl=es-la" target="_blank"><img src="/images/instagram.png" class="img-responsive"></a>
                </div>
                <div class="col-2">
                    <a href="https://www.instagram.com/superfuds/?hl=es-la" target="_blank"><img src="/images/twitter.png" class="img-responsive"></a>
                </div>
                <div class="col-2">
                    <a href="https://www.instagram.com/superfuds/?hl=es-la" target="_blank"><img src="/images/twitter.png" class="img-responsive"></a>
                </div>
                <div class="col-2">
                    <a href="https://www.instagram.com/superfuds/?hl=es-la" target="_blank"><img src="/images/twitter.png" class="img-responsive"></a>
                </div>
            </div>

            <div class="row row-space">
                <div class="col-12 text-center">
                    <h2 class="white-label">Metodos de Pago</h2>
                </div>
            </div>
            <div class="row row-space">
                <div class="col-2 offset-1">
                    <a href="https://www.facebook.com/superfuds/" target="_blank"><p class="text-center"><img src="/images/facebook.png" class="img-responsive"></p></a>
                </div>
                <div class="col-2">
                    <a href="https://www.instagram.com/superfuds/?hl=es-la" target="_blank"><img src="/images/instagram.png" class="img-responsive"></a>
                </div>
                <div class="col-2">
                    <a href="https://www.instagram.com/superfuds/?hl=es-la" target="_blank"><img src="/images/twitter.png" class="img-responsive"></a>
                </div>
                <div class="col-2">
                    <a href="https://www.instagram.com/superfuds/?hl=es-la" target="_blank"><img src="/images/twitter.png" class="img-responsive"></a>
                </div>
                <div class="col-2">
                    <a href="https://www.instagram.com/superfuds/?hl=es-la" target="_blank"><img src="/images/twitter.png" class="img-responsive"></a>
                </div>
            </div>
        </div>
    </div>
<!--    <div class="row"  style="background-color: rgba(0,0,0,.8);">
        <div class="col-12 text-center">
            <h2 class="white-label">ALIADOS</h2>
        </div>
    </div>-->

    <div class="row row-space"  style="background-color: #6dcbb2;">
        <div class="col-12">
            <a href="https://www.facebook.com/superfuds/" target="_blank"><p class="text-center"><img src="/images/aliados.png" class="img-responsive"></p></a>
        </div>
    </div>



    <div class="row" style="background-color: #6dcbb2;">
        <div class="col-lg-12">
            <hr>
        </div>
    </div>
    <div class="row" style="background-color:#6dcbb2;">
        <div class="col-lg-3 col-md-4 col-sm-4" >

            <div class="row">
                <div class="col-lg-12">
                    <span style="color:white;" class="col-lg-offset-1">Superfüds 2018. Todos los derechos reservados</span>   
                </div>
            </div>
        </div>
    </div>

</div>