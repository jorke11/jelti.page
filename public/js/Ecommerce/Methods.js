function MethodsPayment() {
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

        $("#number").blur(this.validateTarjet);

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
        this.getData()
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

    this.formatCurrency = function (n, currency) {
        return currency + " " + n.toFixed(2).replace(/./g, function (c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
        });
    }

    this.setListDetail = function (data) {

        var html = '', html2 = '';

        data.detail.forEach(row => {

            html += `
                            <div class="row mb-3">
                                <div class="col-4">
                                        <img class="img-fluid"  src="${PATH + "/" + row.thumbnail}" alt="Card image cap" >
                                </div>
                                <div class="col-8">
                                    <p>${row.product} <br>
                                       Precio <b>${obj.formatCurrency(parseInt(row.price_sf), "$")}</b><br>
                                    Cantidad <b>${row.quantity}</b></p>
                                </div>
                            </div>
                            `;

            html2 += `
                        
                            <div class="card mb-2">
                                <div class="card-header">
                                  <button type="button" class="close"  aria-label="Close" style="padding-right:1%" onclick=obj.deleteItem(${row.product_id},'${row.id}')><span aria-hidden="true">&times;</span></button>
                                </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="${PATH + "/" + row.thumbnail}" />
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col">
                                                <h3>${row.product}</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p>${obj.formatCurrency(parseInt(row.price_sf), "$")}</p>
                                                <p>Cantidad (${row.quantity})</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        `;
        })

        if (data.total < 10000) {
            $("#btnPay").attr("disabled", true)
            $("#btnPayU").attr("disabled", true)
            $("#message-mount").removeClass("d-none");
        } else {
            $("#btnPay").attr("disabled", false)
            $("#btnPayU").attr("disabled", false)
            $("#message-mount").addClass("d-none");
        }

        $("#tax5").html(obj.formatCurrency(parseInt(data.tax5), "$"))
        $("#tax19").html(obj.formatCurrency(parseInt(data.tax19), "$"))
        $("#totalOrder").html(obj.formatCurrency(parseInt(data.total), "$"))
        $("#subtotalOrder").html(obj.formatCurrency(parseInt(data.subtotal), "$"))
        $("#badge-quantity").html(data.quantity)
        $("#content-detail").html(html2);
        $("#popover-content").html(html);
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


    this.payu = function () {
        var form = $("#frm").serialize();
        $.ajax({
            url: PATH + '/payment/target',
            data: form,
            method: "post",
            success: function () {

            }


        })

    }

    this.deleteItem = function (product_id, order_id) {
        var obj = {};
        obj.product_id = product_id;
        $.ajax({
            url: 'deleteDetail/' + order_id,
            method: 'DELETE',
            data: obj,
            dataType: 'JSON',
            success: function (data) {
                obj.getDetail();
            }
        })
    }
}

var obj = new MethodsPayment();
obj.init();
