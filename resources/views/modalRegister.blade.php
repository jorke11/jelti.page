
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
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" style="background-color: rgba(255,255,255,.8) !important;padding-top: 7%;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(249,247,246,.9) !important;border: 3px solid #ffffff;border-radius: 20px;">

            <div class="modal-body">
                <div class="container-fluid">
                    {!! Form::open(['id'=>'frm']) !!}
                    <div class="row">
                        <div class="col-12">
                            <div class="row row-space">
                                <div class="col-12">
                                    <p style="color:#5c5c5b;font-size:25px;font-weight: 100" class="text-center">Registrate como</p>
                                </div>
                            </div>
                            <div class="row row-space justify-content-center">
                                <div class="col-12">
                                    <div class="row text-center">
                                        <div class="col-6 title-green" onclick="obj.stakeholder(1, this)" id="title-business" style="cursor:pointer">Negocio</div>
                                        <div class="col-6" onclick="obj.stakeholder(2, this)" id="title-supplier" style="cursor:pointer">Proveedor</div>
                                        <input type="hidden" id="type_stakeholder" name="type_stakeholder" class="in-page">
                                    </div>
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-lg-12 ">
                                    <input class="form-control in-page" placeholder="Compañia" type="text" id="business" name="business">
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-lg-12">
                                    <input class="form-control in-page" placeholder="Nombre" type="text" name="name" id="name">
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-lg-12">
                                    <input class="form-control in-page" placeholder="Apellido" type="text" name="last_name" id="last_name">
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-lg-12">
                                    <input class="form-control in-page" placeholder="Email" type="email" name="email" id="email">
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-lg-12">
                                    <input class="form-control in-page input-number" placeholder="Telefono" type="text" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-lg-12">
                                    <input type="checkbox" name="agree" id="agree" class="in-page"><span style="color:#5c5c5b"> Acepto términos de servicio | Leer mas</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button class="btn btn-outline-success my-2 my-sm-0 btn-sm" id="register" type="button">Registrate</button>
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
