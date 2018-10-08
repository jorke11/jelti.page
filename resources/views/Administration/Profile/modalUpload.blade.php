<div class="modal fade" id="myModalUpload" role="dialog" aria-labelledby="myModalLabel" style="background-color: rgba(255,255,255,.8) !important;padding-top: 7%;">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgba(249,247,246,.9) !important;border: 3px solid #ffffff;border-radius: 20px;">

            <div class="modal-body">
                <div class="container-fluid">
                    {!! Form::open(['id'=>'frmUpload','files'=>true]) !!}
                    <input type="hidden" name="stakeholder_id" id="stakeholder_id" >
                    <div class="row">
                        <div class="col-12">
                            <div class="row row-space">
                                <div class="col-12">
                                    <p style="color:#5c5c5b;font-size:25px;font-weight: 100" class="text-center">Documentos</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tipo de documento *</label>
                                    <select id="document_id" class="form-control" name="document_id">
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Archivo</label>
                                    <input type="file" name="document_file" id="document_file" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-right">
                                    <button class="btn btn-outline-success my-2 my-sm-0 btn-sm" id="btn-upload" type="button">Subir</button>
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
