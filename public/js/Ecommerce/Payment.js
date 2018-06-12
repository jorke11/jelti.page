function Payment() {
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


        $("#btnPayU").click(this.payu);
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


    this.formatCurrency = function (n, currency) {
        return currency + " " + n.toFixed(2).replace(/./g, function (c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
        });
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

        var html = '', html2 = '';
        data.detail.forEach((row, index) => {

            if (index < 3) {

                html += `
                            <div class="row mb-3">
                                <div class="col-4">
                                        <img class="img-fluid"  src="${PATH + "/" + row.thumbnail}" alt="Card image cap">
                                </div>
                                <div class="col-8">
                                    <p>${row.product} <br>
                                       Precio <b>${obj.formatCurrency(parseInt(row.price_sf), "$")}</b><br>
                                    Cantidad <b>${row.quantity}</b></p>
                                </div>
                            </div>
                            `;

                html2 += `
                            <div class="card mb-2" id='card_${index}' style="border-radius:15px">
                                <div class="card-body" style="padding-bottom:1%;padding-right:8%">
                                    <div class="row">
                                        <div class="col-12 text-right"><button type="button" class="close"  aria-label="Close" style="padding-right:1%" onclick=obj.deleteItem('${row.slug}','${index}')><span aria-hidden="true">&times;</span></button></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <img src="${PATH + "/" + row.thumbnail}" style="width:95%" class="img-fluid"/>
                                        </div>
                                        <div class="col-7">
                                            <div class="row">
                                                <div class="col">
                                                    <div>
                                                        <span style="color:#827b7b">${row.supplier}</span><br>
                                                        <span style="font-size:20px">${row.product}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style="padding-top:10%">
                                                <div class="col" >
                                                    <p>${obj.formatCurrency(parseInt(row.price_sf), "$")}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 align-middle" style="padding-top:2%">
                                            <div class="row ">
                                                <div class="input-group mb-3 ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" 
                                                                onclick="obj.addProduct('{{$product->short_description}}',
                                                                '{{$product->slug}}','{{$product->id}}','{{$product->price_sf}}','{{url($product->thumbnail)}}','{{$product->tax}}')"
                                                            style="background-color: #30c594;color:white;cursor: pointer">+</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="quantity" name="quantity" value="${row.quantity}" type="number">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" onclick="obj.delete('{{$product->short_description}}',
                                                            '{{$product->slug}}','{{$product->id}}','{{$product->price_sf}}','{{url($product->thumbnail)}}','{{$product->tax}}')" style="background-color: #30c594;color:white;cursor: pointer">-</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                        `;
            }
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


        if ((data.detail).length > 3) {
            $("#btnShowAll").removeClass("d-none")
    }

    }

    this.getDataFirebase = function () {
        db.collection(user_id)
//                .where("state", "==", "CA")
                .onSnapshot(function (querySnapshot) {

                    $("#popover-content").empty();

                    var data = [], html = '', html2 = '', quantity = 0, total = 0, subtotal = 0, tax5 = 0, tax19 = 0;
                    querySnapshot.forEach(function (doc) {
                        html += `
                            <div class="row mb-3">
                                <div class="col-4">
                                        <img class="img-fluid"  src="${doc.data().img}" alt="Card image cap" >
                                </div>
                                <div class="col-8">
                                    <p>${doc.data().title} <br>
                                       Precio <b>${obj.formatCurrency(parseInt(doc.data().price), "$")}</b><br>
                                    Cantidad <b>${doc.data().quantity}</b></p>
                                </div>
                            </div>
                            `;


                        html2 += `
                        
                            <div class="card mb-2">
                                <div class="card-header">
                                  <button type="button" class="close"  aria-label="Close" style="padding-right:1%" onclick=obj.deleteItem(${doc.data().product_id},'${doc.id}')><span aria-hidden="true">&times;</span></button>
                                </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="${doc.data().img}" />
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col">
                                                <h3>${doc.data().title}</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p>${obj.formatCurrency(parseInt(doc.data().price), "$")}</p>
                                                <p>Cantidad (${doc.data().quantity})</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        `;


                        if (doc.data().tax == '0.19') {
                            tax19 += (doc.data().quantity * doc.data().price * doc.data().tax);
                        }

                        if (doc.data().tax == '0.05') {
                            tax5 += (doc.data().quantity * doc.data().price * doc.data().tax);
                        }

                        subtotal += (doc.data().quantity * doc.data().price)
                        quantity += doc.data().quantity;

                        total += subtotal + tax5 + tax19;
                        data.push({title: doc.data().title, img: doc.data().img});
                    });



                    html += ` <div class="row">
                                <div class="col-12">
                                    <form action="/payment" method="GET">
                                        <button class="btn btn-outline-success my-2 my-sm-0 btn-sm form-control" type="submit">Checkout</button>
                                    </form>
                                <div>   
                            </div>`

                    if (total < 10000) {
                        $("#btnPay").attr("disabled", true)
                        $("#btnPayU").attr("disabled", true)
                        $("#message-mount").removeClass("d-none");
                    } else {
                        $("#btnPay").attr("disabled", false)
                        $("#btnPayU").attr("disabled", false)
                        $("#message-mount").addClass("d-none");
                    }

                    $("#tax5").html(obj.formatCurrency(parseInt(tax5), "$"))
                    $("#tax19").html(obj.formatCurrency(parseInt(tax19), "$"))
                    $("#totalOrder").html(obj.formatCurrency(parseInt(total), "$"))
                    $("#subtotalOrder").html(obj.formatCurrency(parseInt(subtotal), "$"))
                    $("#badge-quantity").html(quantity)
                    $("#content-detail").html(html2);
                    $("#popover-content").html(html);
                });

    }


    this.payu = function () {
        window.location.href = PATH + "/selectPay"
    }

    this.redirectProduct = function (url) {
        window.location = PATH + "/productDetail/" + url;
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
                toastr.success("Item Eliminado");
                obj.setListDetail(data);
            }
        })

    }

//    this.deleteItem = function (product_id, document_id) {
//
//        db.collection(user_id).doc(document_id).delete().then(function () {
//            console.log("Document successfully deleted!");
//        }).catch(function (error) {
//            console.error("Error removing document: ", error);
//        });
//    }
}

var obj = new Payment();
obj.init();
