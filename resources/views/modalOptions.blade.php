
@if ($errors->has('email'))
<!--<script>
$(function () {
        $("#modalOptions").modal("show")
    })
</script>-->
@endif


<div class="modal fade " id="modalOptions" role="dialog" aria-labelledby="myModalLabel" style="background-color: rgba(255,255,255,.8) !important;padding-top: 7%;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(249,247,246,.9) !important;border: 3px solid #ffffff;border-radius: 20px;">

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="row row-space">
                                <div class="col-12">
                                    <p style="color:#5c5c5b;font-size:25px;font-weight: 100" class="text-center">No estas registrado?</p>
                                </div>
                            </div>
                            <div class="row row-space justify-content-center">
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-6" id="title-business" style="cursor:pointer">
                                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/loginModal') }}" id="frm-login">
                                                {{ csrf_field() }}
                                                <div class="row text-center" style="padding-bottom: 3%">
                                                    <div class="col-lg-12 title-green">Inicia Sesión</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Correo</label>
                                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus 
                                                                   style="border: 1px solid #ccc">

                                                            <span class="help-block d-none" id="error_email">
                                                                <strong></strong>
                                                            </span>

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Clave</label>
                                                            <input type="password" class="form-control" name="password" required>
                                                            @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <button class="btn btn-success btn-login form-control" type="button" id="btn-login">Ingresar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="col-6  " onclick="objCounter.optionsModal(2)" id="title-supplier" style="cursor:pointer;">
                                            <div class="row" style="padding-top: 50%">
                                                <div class="col-lg-12 center-rowspan" style="font-size:20px">
                                                    Solicita registro!
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="type_stakeholder" name="type_stakeholder" class="in-page">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
