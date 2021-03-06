function Pse() {
    var user_id, detail = [], lengthArr = 3, token = '';
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



        token = $("input[name=_token]").val();
        $("#number").blur(this.validateTarjet);

        $('.container-fluid').click(function () {
            $('#popover-content').popover('hide');
        });


        $("#checkbuyer").click(function () {
            if ($(this).is(":checked")) {
                $("#divaddpayer").addClass("d-none");
                $(".input-extern").removeAttr("required");
            } else {
                $(".input-extern").cleanFields();
                $(".input-extern").prop("required", "required");
                $("#divaddpayer").removeClass("d-none");
            }
        })

        $("#frm #department_buyer_id").on('select2:closing', function (evt) {
            if ($(this).val() != 0) {
                obj.setSelectCity($(this).val());
            }
        })

        $("#frm").submit(function () {
            if (!$("#checkbuyer").is(":checked")) {

                var validate = $(".input-extern").validate();
                if (validate.length > 0) {
                    toastr.error("Datos pendientes");
                    return false;
                }
            }
        })

        $("#btnShowAll").click(this.printDetailAll)


        $("#btnPay").click(this.payCredit);
        $("#btnPSE").click(this.payPSE);
//        this.getDetail();
//        this.getQuantity();

        user_id = $("#user_id").val();

        // Initialize Firebase
//        var config = {
//            apiKey: "AIzaSyBT2aaBBDgYpdd0PPXCOzIpHVY74Fa__sY",
//            authDomain: "jelti-40807.firebaseapp.com",
//            databaseURL: "https://jelti-40807.firebaseio.com",
//            projectId: "jelti-40807",
//            storageBucket: "jelti-40807.appspot.com",
//            messagingSenderId: "145976538184"
//        };
//        firebase.initializeApp(config);
//
//        db = firebase.firestore();

//        this.getDataFirebase()
        this.getData()
    }

    this.printDetailAll = function () {

        var btn = '';

        if (lengthArr > 3) {
            lengthArr = 3;
            btn = `
            <svg id="i-chevron-bottom" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M30 12 L16 24 2 12" />
                        </svg>
                `
            $("#btnShowAll").html("Ver todo " + btn);
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        } else {
            btn = `
                <svg id="i-chevron-top" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M30 20 L16 8 2 20" />
                </svg>`
            $("#btnShowAll").html("Ocultar items " + btn);
            lengthArr = detail.length;

        }

        obj.printDetail()
    }



    this.printDetail = function () {
        var html = '';
        var slug = "";
        for (var i = 0; i < lengthArr; i++) {
            if (detail[i] != undefined) {
                slug = (detail[i].supplier).toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '')
                html += `
                            <div class="card mb-2" id='card_${i}' style="border-radius:15px">
                                <div class="card-body" style="padding-bottom:1%;padding-right:8%">
                                    <div class="row">
                                        <div class="col-12 text-right"><button type="button" class="close"  aria-label="Close" style="padding-right:1%" 
                                        onclick=obj.deleteItem('${detail[i].slug}','${i}')><span aria-hidden="true">&times;</span></button></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="https://superfuds.com/${detail[i].thumbnail}" style="width:95%;cursor:pointer" class="img-fluid" 
                                            onclick="objCounter.redirectProduct('${detail[i].slug}')"/>
                                        </div>
                                        <div class="col-7">
                                            <div class="row">
                                                <div class="col">
                                                    <div>
                                                        <span ><a href="/search/s=${slug}"style="color:#827b7b">${detail[i].supplier}</a></span><br>
                                                        <span style="font-size:20px;cursor:pointer" onclick="objCounter.redirectProduct('${detail[i].slug}')">${detail[i].product}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail[i]" style="padding-top:10%">
                                                <div class="col" >
                                                    <p>${detail[i].price_sf}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 align-middle" style="padding-top:2%">
                                            <div class="row">
                                                <div class="input-group mb-3 ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" onclick="objCounter.deleteUnit('${detail[i].product_id}','${detail[i].slug}',${i})" style="background-color: #30c594;color:white;cursor: pointer">-</span>
                                                        
                                                    </div>
                                                    <input type="text" class="form-control" id="quantity_payment_${detail[i].product_id}" value="${detail[i].quantity}" type="number">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" 
                                                                onclick="obj.addProduct('${detail[i].product}',
                                                                '${detail[i].slug}','${detail[i].product_id}',
                                                                '${detail[i].price_sf}}','${detail[i].thumbnail}','${detail[i].tax}')"
                                                            style="background-color: #30c594;color:white;cursor: pointer">+</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                        `;
            }

        }

        $("#content-detail").html(html);
    }

    this.deleteUnit = function (product_id, slug, index) {
        $("#quantity_payment_" + product_id).val(parseInt($("#quantity_" + product_id).val()) - 1)
        var row = {
            quantity: $("#quantity_payment_" + product_id).val(),
            product_id: product_id
        }

        $.ajax({
            url: PATH + '/deleteProductUnit/' + slug,
            method: 'PUT',
            headers: {'X-CSRF-TOKEN': token},
            data: row,
            success: function (data) {
                $("#content-detail").empty();
                $("#frm #total").val($.formatNumber(data.total, "$"))
                $("#frmPayment #total").val($.formatNumber(data.total, "$"))

                if (data.success == false) {
                    $("#card_" + index).remove()
                } else {
                    objCounter.setData(data);
                    detail = data.detail
                    obj.printDetail()
                }

                if (parseInt(data.total) > 10000) {
                    $("#message-mount").addClass("d-none")
                    $("#btnPayU").attr("disabled", false)
                } else {
                    $("#message-mount").removeClass("d-none")
                    $("#btnPayU").attr("disabled", true)
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
//                console.log(xhr)
//                console.log(ajaxOptions)
//                console.log(thrownError)
            }

        })


    }

    this.addProduct = function (title, slug, product_id, price_sf, img, tax) {

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
                    $("#badge-quantity").attr("font-size", '90%').css("background-color", "#ebf91c");
                },
                success: function (data) {
                    objCounter.setData(data);
                    detail = data.detail
                    obj.printDetail()
                    $("#frm #total").val($.formatNumber(data.total, "$"))
                    $("#frmPayment #total").val($.formatNumber(data.total, "$"))
                    $("#badge-quantity").attr("font-size", '70%').css("background-color", "#f8f9fa");

                    $("#quantity_product_" + product_id).html(data.row.quantity)
                    if (parseInt(data.total) > 10000) {
                        $("#message-mount").addClass("d-none")
                        $("#btnPayU").attr("disabled", false)
                    } else {
                        $("#message-mount").removeClass("d-none")
                        $("#btnPayU").attr("disabled", true)
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {

                }

            })
        } else {
            $("#myModal").modal("show");
        }
    }



    this.setSelectCity = function (department_id) {
        var html = '';

        $.ajax({
            url: 'getCity/' + department_id,
            method: 'get',
            dataType: 'JSON',
            success: function (data) {
                $("#city_buyer_id").empty();
                $.each(data, function (i, val) {
                    html += "<option value='" + val.id + "'>" + val.description + "</option>"
                })

                $("#city_buyer_id").html(html);
            }
        })

    }


    this.validateTarjet = function () {
        var amex = /^(3[47]\d{13})$/
        if (amex.test(this.value)) {
            $("#crc").attr("maxlength", 4).val("");
            $("#imgCard").attr("src", PATH + "/images/amex.jpg");
        } else {
            $("#crc").attr("maxlength", 3).val("");
            $("#imgCard").attr("src", PATH + "/images/visa.png");
        }


//        if (preg_match('/[0-9]{4,}\/[0-9]{2,}$/', $expire)) {
//
//                    //VISA
//                    if (preg_match('/^(4)(\d{12}|\d{15})$|^(606374\d{10}$)/', $number)) {
//                        $response = array("paymentMethod" => 'VISA', "status" => true);
//                    } else {
//                        //AMERICAN EXPRESSS
//                        if (preg_match('/^(3[47]\d{13})$/', $number)) {
//                            $response = array("paymentMethod" => 'AMEX', "status" => true);
//                        } else {
//                            //MASTERCARD
//                            if (preg_match('/^(5[1-5]\d{14}$)|^(2(?:2(?:2[1-9]|[3-9]\d)|[3-6]\d\d|7(?:[01]\d|20))\d{12}$)/', $number)) {
//                                $response = array("paymentMethod" => 'MASTERCARD', "status" => true);
//                            } else {
//                                if (preg_match('/(^[35](?:0[0-5]|[68][0-9])[0-9]{11}$)|(^30[0-5]{11}$)|(^3095(\d{10})$)|(^36{12}$)|(^3[89](\d{12})$)/', $number)) {
//                                    $response = array("paymentMethod" => 'DINERS', "status" => true);
//                                } else {
//                                    if (preg_match('/^590712(\d{10})$/', $number)) {
//                                        $response = array("paymentMethod" => 'CODENSA', "status" => true);
//                                    } else {
//                                        $response = array("status" => false, "msg" => "Formato de la tarjeta no valido");
//                                    }
//                                }
//                            }
//                        }
//                    }
//                } else {
//                    $response = array("status" => false, "msg" => "Fecha de Expiracion not valida");
//                }

    }


    this.getData = function () {

        if (user_id) {
            $.ajax({
                url: PATH + '/getCounter',
                method: 'GET',
                success: function (data) {

                    obj.setListDetail(data);
                }, error: function (xhr, ajaxOptions, thrownError) {
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
                }

            })
        }
    }


    this.setListDetail = function (data, all = false) {

        var html = '';
        detail = data.detail

        this.printDetail(3)

        if (data.total < 10000) {
            $("#btnPay").attr("disabled", true)
            $("#btnPayU").attr("disabled", true)
            $("#message-mount").removeClass("d-none");
        } else {
            $("#btnPay").attr("disabled", false)
            $("#btnPayU").attr("disabled", false)
            $("#message-mount").addClass("d-none");
        }

        $("#tax5").html(parseInt(data.tax5))
        $("#tax19").html(parseInt(data.tax19))
        $("#totalOrder").html(parseInt(data.total))
        $("#subtotalOrder").html(parseInt(data.subtotal))
        $("#badge-quantity").html(data.quantity)


        if ((data.detail).length > 3)
            $("#btnShowAll").removeClass("d-none");

    }

    
    this.payCredit = function () {
        window.location = PATH + "/payment-credit";
    }
    this.payPSE = function () {
        window.location = PATH + "/pse";
    }

    this.updateQuantity = function (order_id, product_id, input) {
        toastr.remove();
        var param = {};
        param.product_id = product_id;
        param.quantity = input.value;
        $.ajax({
            url: 'getDetailQuantity/' + order_id,
            method: 'PUT',
            data: param,
            dataType: 'JSON',
            success: function (data) {
                if (data.success == true) {
                    toastr.success("Cantidad editada");
                    obj.setQuantity();
                    obj.getDetail();
                }
            }
        })
    }

    this.setQuantity = function () {
        var html = "";
        $.ajax({
            url: PATH + '/getCounter',
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {

                $("#quantityOrders").html(data.quantity);
            }
        })

    }

    this.deleteItem = function (slug, index) {

        var token = $("input[name=_token]").val();

        $.ajax({
            url: 'deleteAllProduct/' + slug,
            headers: {'X-CSRF-TOKEN': token},
            method: 'PUT',
            dataType: 'JSON',
            success: function (data) {

                $("#card_" + index).remove()
                $("#frm #total").val($.formatNumber(data.total, "$"))
                toastr.success("Item Eliminado");
                obj.setListDetail(data);

                if (parseInt(data.total) > 10000) {
                    $("#message-mount").addClass("d-none")
                    $("#btnPayU").attr("disabled", false)
                } else {
                    $("#message-mount").removeClass("d-none")
                    $("#btnPayU").attr("disabled", true)
                }
            }
        })

    }
}

var obj = new Pse();
obj.init();
