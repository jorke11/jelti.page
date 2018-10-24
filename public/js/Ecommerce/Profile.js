function Profile() {
    var client = {}, type_document = [], token;
    this.init = function () {

        token = $("input[name=_token]").val();

        $("#btn-edit").click(function () {
            $("#form-info").addClass("d-none")
            $("#form-input").removeClass("d-none")
            $(".form-profile").setFields({data: client})

        })

        $("#btn-show-upload").click(function () {
            $.ajax({
                url: 'type-document',
                method: 'GET',
                success: function (data) {
                    $("#document_id").fillSelect(data)
                    $("#frmUpload #stakeholdel_id").val($("#frmProfile #id").val())
                    $("#myModalUpload").modal("show");

                }
            })
        });

        $("#btn-upload").click(function () {
            var formData = new FormData($("#frmUpload")[0]);
            $.ajax({
                url: 'upload-document',
                type: 'POST',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                dataType: 'JSON',
                beforeSend: function () {
                    $(".cargando").removeClass("hidden");
                },
                success: function (data) {
                    objProfile.listDocument(data);
                    $("#myModalUpload").modal("hide");
                }, error: function (xhr, ajaxOptions, thrownError) {
                    //clearInterval(intervalo);
                    console.log(thrownError)
                    alert("Problemas con el archivo, informar a sistemas");
                }
            });
        })

        $("#copy-info").click(function () {
            if ($(this).is(":checked")) {
                $("#address_invoice").val($("#address_send").val());
            } else {
                $("#invoice_city_id").val($("#city_id").val()).change()
                $("#address_invoice").val("");
            }
        })

        $("#btn-next").click(function () {
            var validate = $(".form-profile").validate();

            if (validate.length == 0) {
                $("#step1").addClass("d-none");
                $("#btn-next").addClass("d-none");
                $("#btn-end").removeClass("d-none");
                $("#step2").removeClass("d-none");
                $("#circle-user").removeClass("active").addClass("disabled");
                $("#circle-doc").removeClass("disabled").addClass("active");
            }

        })

        $("#tab-user").click(function () {
            $("#step1").removeClass("d-none");
            $("#btn-next").removeClass("d-none");
            $("#step2").addClass("d-none");
            $("#btn-end").addClass("d-none");
            $("#circle-user").addClass("active").removeClass("disabled");
            $("#circle-doc").addClass("disabled").removeClass("active");
        })

//        $("#frmProfile").submit(function(){
//            $("#step1").removeClass("d-none");
//        })

        this.getInfo();
    }

    this.listDocument = function (data) {
        $("#table-documents tbody").empty();
        var html = '';
        data.forEach(val => {
            html += ` 
            <tr>
                    <td>${val.description}</td>
                    <td>
                        <a href="images/stakeholder/${val.path}" target="_blank" class="btn btn-info btn-sm mt-10" >Ver</a>
                        <a href="#" class="btn btn-danger ml-4 btn-sm" onclick=objProfile.deleteDocument('${val.document_id}')>Eliminar</a>
                    </td>
            </tr>
                    `;

        })
        $("#table-documents tbody").html(html);
    }

    this.deleteDocument = function (id) {
        $.ajax({
            url: `/quit-document/${id}`,
            headers: {'X-CSRF-TOKEN': token},
            method: 'DELETE',
            success: function (data) {
                objProfile.listDocument(data);
            }
        })

    }

    this.getInfo = function () {
        var html = '';
        $.ajax({
            url: 'data-user',
            method: 'GET',
            success: function (data) {
                client = data.client;

                if (data.client_pending.avg == 100) {
                    $("#progress-info").addClass("d-none");
                } else {
                    $("#progress-info").removeClass("d-none");
                }

                $("#info-complete").html(data.client_pending.avg + "%").css("width", data.client_pending.avg + "%");



                $(".form-label").each(function () {
                    var elem = $(this);
                    Object.keys(client).forEach((val, index) => {
                        if (elem.attr("name") == val) {
                            elem.html(client[val]);
                        }
                    })
                });

                type_document = data.type_document_id;

                $("#sector_id").fillSelect(data.sector_id);
                $("#type_document_id").fillSelect(data.type_document_id);
                $("#type_person_id").fillSelect(data.type_person_id);
                $("#type_regime_id").fillSelect(data.type_regime_id);

                objProfile.listDocument(data.documents)

                $(".form-profile").setFields({data: client})
            }
        })

    }
}

var objProfile = new Profile();
objProfile.init()