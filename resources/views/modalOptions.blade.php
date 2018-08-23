
<style>
    .modal-content {
        background-color: rgba(255,255,255,.6)
    }
    .title-green{
        color: #28a745;
        font-size: 26px;
        cursor: pointer;
    }
    .vertical-align {
        display: flex;
        align-items: center;
    }
</style>
<div class="modal fade" id="modalOptions" role="dialog" aria-labelledby="myModalLabel" style="background-color: rgba(255,255,255,.8) !important;padding-top: 7%;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(249,247,246,.9) !important;border: 3px solid #ffffff;border-radius: 20px;">

            <div class="modal-body">
                <div class="container-fluid">
                    {!! Form::open(['id'=>'frm']) !!}
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
                                        <div class="col-6" onclick="objCounter.optionsModal(1)" id="title-business" style="cursor:pointer">
                                            <div class="row text-center" style="padding-bottom: 3%">
                                                <div class="col-lg-12 title-green">
                                                    Inicia Sesión
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Correo</label>
                                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Clave</label>
                                                        <input type="email" class="form-control" id="password" aria-describedby="emailHelp" placeholder="Clave">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <button class="btn btn-success btn-login form-control">Ingresar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 column-in-center" onclick="objCounter.optionsModal(2)" id="title-supplier" style="cursor:pointer">
                                            <div class="row align-items-center">
                                                <div class="col-lg-12">
                                                    Solicita registro
                                                </div>
                                            </div>

                                        </div>
                                        <input type="hidden" id="type_stakeholder" name="type_stakeholder" class="in-page">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
