
<style>
    .modal-content {
        background-color: rgba(255,255,255,.6)
    }
    .title-green{
        color: #28a745;
        font-size: 26px;
        cursor: pointer;
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
                                    <div class="row text-center">
                                        <div class="col-6 title-green" onclick="objCounter.optionsModal(1)" id="title-business" style="cursor:pointer">Inicia Sesion</div>
                                        <div class="col-6" onclick="objCounter.optionsModal(2)" id="title-supplier" style="cursor:pointer">Solicita registro</div>
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
