function Profile() {
    var client = {}, type_document = [];
    this.init = function () {
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
                    $("#typedocument_id").fillSelect(data)
                    $("#myModalUpload").modal("show");
                }
            })




        })

        this.getInfo()
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
            }
        })

    }
}

var objProfile = new Profile();
objProfile.init()