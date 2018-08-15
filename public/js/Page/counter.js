function Counter() {
    var id = 1;
    var param = [];
    var db;
    var user_id;
    this.init = function () {

        $('.input-number').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $('.input-alpha').on('input', function () {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });

        $('.input-date').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });


        $("[data-toggle=popover]").popover({
            html: true,
            content: function () {
                var id = $(this).attr('id')
                return $('#popover-content').html();
            }
        });
        user_id = $("#user_id").val();
        this.getData();

        $(".list-category").each(function () {
            var elem = $(this);

            if (elem.is(":checked")) {
                console.log(elem.val());
            }

        })


        $(window).scroll(function () {

            //Efect when down scroll
            if ($(this).scrollTop() > 0) {

                $("#main-menu-id").removeClass("main-menu").addClass("main-menu-out");
//                $("#main-menu-id").removeClass("main-menu");
//                $("#slider-main").removeClass("main-slider");
//                $("#popover220259").css({"transform": "translate3d(1493px,  337px, 0px)"})
                $('.go-top').slideDown(300);
//                $("#content-menu").css("height", "height:100px")

                $("#content-menu").height(500)
            } else {

                $(".popover").css("transform", "translate3d(1493px, 110px, 0px)")
                $("#main-menu-id").addClass("main-menu").removeClass("main-menu-out");
//                $("#slider-main").addClass("main-slider");
                $('.go-top').slideUp(300);
                $("#content-menu").height(720)
//                $("#content-menu").css("height", "height:720px")

            }
        });

        $('.go-top').click(function () {
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        });


        $('.go-top').click(function () {
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        });


        $("#frmSearch").submit(function () {
            var search_data = $("#text-search").val();
            if (search_data != '') {
                location.href = PATH + "/search/" + search_data
                return false;
            }
            return false;

        })
        $("#btnSearch").click(function () {
            var search_data = $("#text-search").val();

            if (search_data != '') {
                location.href = PATH + "/search/" + search_data
                return false;
            }

            return false;
        })

        $(document).keydown(function (e) {
            if (e.which == 13) {
                var search_data = $("#text-search").val();

                if (search_data != '') {
                    location.href = PATH + "/search/" + search_data
                    return false;
                }
                return false;
            }
        });



        $(".box-client").addClass("back-green");
        $("#type_stakeholder").val(id);

        $("#register").click(function () {
            var elem = $(this);
            elem.attr("disabled", true);
            toastr.remove();

            var valida = $(".in-page").validate();

            if (!$("#agree").is(":checked")) {
                toastr.error("Necesita estar de acuerdo con los terminos Legales");
                elem.attr("disabled", false);
                return false;
            }
            if ($("#type_stakeholder").val() == 2 && $("#what_make").val() == '') {
                toastr.warning("Cuentanos un poco a que te dedicas");
                elem.attr("disabled", false);
                return false;
            }


            var form = $("#frm");

            if (valida.length == 0) {
                $.ajax({
                    url: 'newVisitan',
                    method: 'POST',
                    data: form.serialize(),
                    success: function (data) {
                        if (data.status == true) {
                            toastr.success("Pronto te estaremos contactando");
                            $(".in-page").cleanFields();
                            $("#myModal").modal("hide");
                        }
                    }, error: function (xhr, ajaxOptions, thrownError) {
                        toastr.error(xhr.responseJSON.msg);
                        elem.attr("disabled", false);
                    }

                })

                elem.attr("disabled", false);
            } else {
                elem.attr("disabled", false);
                toastr.error("Es necesario ingresar los datos");
            }
        });

        $("#keepbuying").click(function () {
            location.href = PATH;
        })


    }


    this.addProduct = function (title, slug, product_id, price_sf, img, tax) {
        var token = $("input[name=_token]").val();
        var row = {
            quantity: 1,
            title: title,
            product_id: product_id,
            price_sf: price_sf,
            img: img,
            tax: tax
        }

        if (user_id) {
            $.ajax({
                url: PATH + '/addProduct/' + slug,
                method: 'PUT',
                headers: {'X-CSRF-TOKEN': token},
                data: row,
                success: function (data) {
                    objCounter.setData(data);
                    $("#quantity_selected_" + product_id).html("Cantidad Seleccionada (" + data.current.quantity + ")")
                }, error: function (xhr, ajaxOptions, thrownError) {

                }

            })
        } else {
            $("#myModal").modal("show");
        }
    }


    this.getData = function () {

        if (user_id != undefined) {
            $.ajax({
                url: PATH + '/getCounter',
                method: 'GET',
                success: function (data) {
                    objCounter.setData(data);

                }, error: function (xhr, ajaxOptions, thrownError) {
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
                }

            })
        }
    }

    this.setData = function (data) {
        $("#badge-quantity").html(data.quantity)

        var html = '';
        if (data.detail != false) {
            data.detail.forEach((row, index) => {
                if (index < 3) {
                    html += `
                            <div class="row mb-3">
                                <div class="card">
                                    <div class="card-body" style="padding:5%">
                                        <div class="row">
                                            <div class="col-4">
                                                <img class="img-fluid"  src="https://superfuds.com/${row.thumbnail}" alt="Card image cap" style="max-width: 160%;cursor:pointer" 
                                                 onclick="obj.redirectProduct('${row.slug}')">
                                            </div>
                                            <div class="col-8">
                                                <p>${row.product} <br>
                                                Precio <b>${$.formatNumber(parseInt(row.price_sf), "$")}</b><br>
                                                Cantidad <b>${row.quantity}</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;

                }
            })
        }

        html += ` 
                <div class="row">
                    <div class="col-12 text-center">
                         Item total:${data.detail.length}
                    <div>   
                <div>   
                
                <div class="row">
                    <div class="col-12">
                         <form action="/payment" method="GET">
                            <button class="btn btn-outline-success my-2 my-sm-0 btn-sm form-control" type="submit">Checkout</button>
                        </form>
                    <div>   
                </div>`

        $("#popover-content").html(html);


    }
}

objCounter = new Counter();
objCounter.init();