function Profile() {
    var client = {};
    this.init = function () {
        $("#btn-edit").click(function () {
            $("#form-info").addClass("d-none")
            $("#form-input").removeClass("d-none")
            $(".form-profile").setFields({data: client})

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
                $(".form-label").each(function () {
                    var elem = $(this);
                    Object.keys(client).forEach((val, index) => {
                        if (elem.attr("name") == val) {
                            elem.html(client[val]);
                        }
                    })
                });

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