function Counter() {
    var id = 1;
    var param = [];
    var db;
    var user_id, token;
    this.init = function () {
        token = $("input[name=_token]").val();

        $('.input-number').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $('.input-alpha').on('input', function () {
            this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
        });

        $('.input-date').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });


//        $('body').on('click', function (e) {
//            //did not click a popover toggle, or icon in popover toggle, or popover
//            console.log($(e.target).data('toggle'));
//            console.log($(e.target).parents('[data-toggle="popover"]'));
//            console.log($(e.target).parents('.popover.in'));
//            if ($(e.target).data('toggle') !== 'popover'
//                    && $(e.target).parents('[data-toggle="popover"]').length === 0
//                    && $(e.target).parents('.popover.in').length === 0) {
//                $('[data-toggle="popover"]').popover('hide');
//            }
//        });

//        var options = {
//            placement: function (context, source) {
//                var position = $(source).position();
//
//console.log(position.left)
//
//                if (position.left > 515) {
//                    return "bottom";
//                }
//
//                if (position.left < 515) {
//                    return "right";
//                }
//
//                if (position.top < 110) {
//                    return "bottom";
//                }
//
//                return "top";
//            }
//            , trigger: "click"
//        };
//        $("[data-toggle=popover]").popover(options);



        $("[data-toggle=popover]").popover({
            html: true,
            content: function () {
                var id = $(this).attr('id')
                return $('#popover-content').html();
            }
        });



        $("#popover-card").mouseover(function () {
            $("[data-toggle=popover]").popover("show");
        })

        $("#popover-card").mouseout(function () {
            $("[data-toggle=popover]").popover("hide");
        })
        $("#popover-card").click(function () {
            location.href = PATH + "/payment"
        })


        user_id = $("#user_id").val();
        this.getData();

        $(".list-category").each(function () {
            var elem = $(this);

            if (elem.is(":checked")) {
                console.log(elem.val());
            }

        })


//        $(window).scroll(function () {
//
//            //Efect when down scroll
//            if ($(this).scrollTop() > 0) {
//
//                $("#main-menu-id").removeClass("main-menu").addClass("main-menu-out");
////                $("#main-menu-id").removeClass("main-menu");
////                $("#slider-main").removeClass("main-slider");
////                $("#popover220259").css({"transform": "translate3d(1493px,  337px, 0px)"})
//                $('.go-top').slideDown(300);
//                $("#content-menu").height(300)
//                $("#content-image").css("top", 100);
//
//            } else {
//
//                $("#content-image").css("top", -300);
//                $(".popover").css("transform", "translate3d(1493px, 110px, 0px)")
//                $("#main-menu-id").addClass("main-menu").removeClass("main-menu-out");
//                $('.go-top').slideUp(300);
//                $("#content-menu").height(720)
//
//            }
//        });

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

    this.optionsModal = function (opt) {
        if (opt == 1) {
            location.href = "/login"
        } else {
            $("#modalOptions").modal("hide");
            $("#myModal").modal("show");
        }
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
                beforeSend: function () {
                    $("#loading-super").removeClass("d-none");
                    $("#btn-plus-product_" + product_id).attr("disabled", true);
                },
                success: function (data) {
                    objCounter.setData(data);
                    $("#quantity_product_" + product_id).html(data.current.quantity)
                    $("#quantity_selected_" + product_id).html("Cantidad (" + data.current.quantity + ")")
                    $("#loading-super").addClass("d-none");
                    $("#btn-plus-product_" + product_id).attr("disabled", true);
                    $("#quantity").val(data.current.quantity)
                }, error: function (xhr, ajaxOptions, thrownError) {

                }

            })
        } else {
            $("#modalOptions").modal("show");
        }
    }

    this.deleteUnit = function (product_id, slug, index) {
        $("#quantity_" + product_id).val(parseInt($("#quantity_" + product_id).val()) - 1)
        var row = {
            quantity: $("#quantity_" + product_id).val(),
            product_id: product_id
        }

        $.ajax({
            url: PATH + '/deleteProductUnit/' + slug,
            method: 'PUT',
            headers: {'X-CSRF-TOKEN': token},
            data: row,
            beforeSend: function () {
                $("#loading-super").removeClass("d-none");
            },
            success: function (data) {
//                $("#content-detail").empty();
                if (data.row.quantity > 0) {
                    $("#quantity_product_" + product_id).html(data.row.quantity)
                } else {
                    $("#buttonAdd_" + product_id).addClass("d-none");
                    $("#btnOption_" + product_id).removeClass("d-none");
                }
                $("#loading-super").addClass("d-none");

                objCounter.setData(data);
            }, error: function (xhr, ajaxOptions, thrownError) {
//                console.log(xhr)
//                console.log(ajaxOptions)
//                console.log(thrownError)
            }

        })


    }

    this.showButton = function (description, slug, id, price, thumbnail, tax) {
        console.log(user_id);

        if (user_id) {
            $("#buttonAdd_" + id).removeClass("d-none");
            $("#btnOption_" + id).addClass("d-none");
            objCounter.addProduct(description, slug, id, price, thumbnail, tax);
        } else {
            $("#modalOptions").modal("show");
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
//                if (index < 3) {
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
                                                
                                                 <div class="row" style="width:70%;z-index:1000">
                                                <div class="input-group mb-2 offset-1">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" 
                                                                onclick="objCounter.addProduct('${row.product}',
                                                                '${row.slug}','${row.product_id}',
                                                                '${row.price_sf}}','$deleteUnit{row.thumbnail}','${row.tax}')"
                                                            style="background-color: #30c594;color:white;cursor: pointer">+</span>
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm" id="quantity_${row.product_id}" name="quantity" value="${row.quantity}" type="number">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" onclick="objCounter.deleteUnit('${row.product_id}','${row.slug}',${index})" style="background-color: #30c594;color:white;cursor: pointer">-</span>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;

//                }
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