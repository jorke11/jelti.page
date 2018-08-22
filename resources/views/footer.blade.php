<style>
    #categories-footer .list-group-item {
        background-color: rgba(255,255,255,0);
        color:rgba(255,255,255,1);
        padding: .60rem 1.25rem;
        border: 0px;
        font-size: 20px
    }
    .footer-template{
        /*        padding-top: 100px;
                position: relative;
                transition: all 1s ease;*/
        background-repeat: no-repeat;
        /*background-position-y: -20px;*/
        background-image: url("/images/fondofooter.png");
        /*            -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
        */
        background-size: cover;
        width: 100%;
    }
    .link-white{
        color:white !important;
        font-size: 15px
    }
    .titles-footer{
        color:white;
    }
</style>
<div class="container-fluid footer-template">
    <!--<div class="row" style="background-color: rgba(0,0,0,.8);">-->
    <div class="row" >
        <div class="col-5" style="padding-top: 2%;padding-bottom: 2%"  id="categories-footer">
            <div class="row">
                <div class="col-4">
                    <ul class="list-group">
                        <li class="list-group-item">CATEGORÍAS</li>
                        @foreach($categories as $val)
                        <li class="list-group-item"><a class="link-white" href="{{url("/products/".$val->slug)}}">{{ucwords(strtoupper($val->description))}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-4 d-none d-lg-block d-md-none d-sm-block">
                    <ul class="list-group">
                        <li class="list-group-item">DIETAS</li>
                        @foreach($dietas as $val)
                        <li class="list-group-item"><a class="link-white" href='{{url("search/s=".$val->slug)}}'>{{strtoupper($val->description)}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <!--                <div class="col-4 d-none d-lg-block d-sm-block d-md-none">
                                    <ul class="list-group">
                                        <li class="list-group-item"><b>SF</b></li>
                                        @foreach($categories as $val)
                                        <li class="list-group-item">{{$val->description}}</li>
                                        @endforeach
                                    </ul>
                                </div>-->
            </div>

        </div>
        <div class="col-2 text-center" style="padding-top: 2%;">

        </div>
        <div class="col-5" style="padding-top: 2%;">
            <div class="row row-space">
                <div class="col-12 col-lg-12 text-center">
                    <h5 class="titles-footer">SÍGUENOS</h5>
                </div>
            </div>
            <div class="row row-space justify-content-center">
                <div class="col-lg-2 col-4">
                    <a href="https://www.facebook.com/superfuds/" target="_blank"><p class="text-center"><img src="/images/page/facebook.svg" class="img-fluid" style="width: 90%"></p></a>
                </div>
                <div class="col-lg-2 col-4">
                    <a href="https://www.instagram.com/superfuds/?hl=es-la" target="_blank"><img src="/images/page/instagram.svg" class="img-fluid" style="width: 90%"></a>
                </div>
                <div class="col-lg-2 col-4">
                    <a href="https://www.youtube.com/channel/UC4YzleJ0zrgAGHwhV74R_GA/featured" target="_blank"><img src="/images/page/youtube.svg" class="img-fluid" style="width: 90%"></a>
                </div>
                <div class="col-lg-2 col-4">
                    <a href="https://co.pinterest.com/superfuds/" target="_blank"><img src="/images/page/pinterest.svg" class="img-fluid" style="width: 90%"></a>
                </div>
                <div class="col-lg-2  col-4">
                    <a href="https://plus.google.com/112289524335507891140" target="_blank"><img src="/images/page/google.svg" class="img-fluid" style="width: 90%"></a>
                </div>
            </div>

            <div class="row row-space">
                <div class="col-12 text-center">
                    <h5 class="titles-footer">MÉTODOS DE PAGO</h5>
                </div>
            </div>
            <div class="row row-space row-center">
                <div class="col-2 offset-1 col-lg-2">
                    <a href="https://www.americanexpress.com/" target="_blank"><img src="/images/page/logoamex.svg" class="img-fluid"></a>
                </div>
                <div class="col-2 col-lg-2">
                    <a href="https://www.mastercard.com/global.html" target="_blank">
                        <img src="/images/page/logomastercard.svg" class="img-fluid">
                    </a>
                </div>
                <div class="col-2">
                    <a href="https://www.visa.com.co/" target="_blank"><img src="/images/page/logovisa.svg" class="img-fluid"></a>
                </div>
                <div class="col-2">
                    <a href="https://www.mundodinersclub.com/" target="_blank"><img src="/images/page/logodinners.svg" class="img-fluid"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center">
        <div class="col">
            <div class="row">
                <div class="col"><h2 class="text-white">Aliados</h2></div>
            </div>
            <div class="row justify-content-center">
                <div class="col-2">
                    <a href="https://www.innpulsacolombia.com/" target="_blank"><p class="text-center"><img src="/images/endeavor_logo.png" class="img-fluid"></p></a>
                </div>
                <div class="col-2">
                    <a href="https://endeavor.org/location/colombia/" target="_blank"><p class="text-center"><img src="/images/impulsa_logo.png" class="img-fluid"></p></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <hr>
        </div>
    </div>
    <div class="row" >
        <div class="col" >

            <div class="row">
                <div class="col-lg-12">
                    <span style="color:white;" class="col-lg-offset-1">SuperFüds 2018. Todos los derechos reservados</span>   
                </div>
            </div>
        </div>
    </div>

</div>