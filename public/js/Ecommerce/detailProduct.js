function detailProduct() {
    var user_id;
    this.init = function () {
        $('body').click(function (e) {
            $('#popover-content').popover('hide');
        });

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

//        db = firebase.firestore();
//        db = firebase.firebase();

//        this.getDataFirebase()


        $("#AddProduct").click(this.addProduct);
        $("#btnOpenModal").click(this.modalComment);
        this.getComment();
//        this.getQuantity();


        $("#btnFavourite").click(this.addFavourite)

        $("#quantity").change(function () {
            if ($(this).val() > 0) {
                $("#btnAddCart").attr("disabled", false);
            } else {
                $("#btnAddCart").attr("disabled", true);
            }
        });

        $("#btnSendComment").click(this.addComment)

    }

    this.answer = function (comment_id) {
        $("#frmComment #answer_id").val(comment_id);
        $("#modalComment").modal("show");
    }

    this.addCard = function (title, slug, product_id, price_sf, img, tax) {
        if ($("#quantity").val() > 0) {
            var token = $("input[name=_token]").val();
            var row = {
                quantity: $("#quantity").val(),
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
                    }, error: function (xhr, ajaxOptions, thrownError) {

                    }

                })
            } else {
                $("#myModal").modal("show");
            }
        }
    }

    this.addFavourite = function () {
        if (user_id == undefined) {
            obj.registerClient();
            return false;
        }

        var slug = $("#slug").val();
        var token = $("input[name=_token]").val();

        $.ajax({
            url: PATH + '/addFavourite/' + slug,
            method: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            success: function (data) {
                if (data.like == true) {
                    $("#i-heart").attr("fill", "red").attr("stroke", "red");
                    $("#btnFavourite span").text("");
                } else {
                    $("#i-heart").attr("fill", "none").attr("stroke", "black");
                    $("#btnFavourite span").text("Añadir a favoritos");
                }
            }, error: function (xhr, ajaxOptions, thrownError) {

            }
        })
    }


    this.registerClient = function () {
        $("#myModal").modal("show");
    }

    this.getDataFirebase = function () {
        db.collection(user_id)
//                .where("state", "==", "CA")
                .onSnapshot(function (querySnapshot) {

                    $("#popover-content").empty();

                    var data = [], html = '', quantity = 0, total;
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
                        quantity += doc.data().quantity;
                        data.push({title: doc.data().title, img: doc.data().img});
                    });

                    html += ` <div class="row">
                                <div class="col-12">
                                    <form action="/payment" method="GET">
                                        <button class="btn btn-outline-success my-2 my-sm-0 btn-sm form-control" type="submit">Checkout</button>
                                    </form>
                                <div>   
                            </div>`

                    $("#badge-quantity").html(quantity)
                    $("#popover-content").html(html);
                });

    }

    this.modalComment = function () {
        $("#txtTitle").val("");
        $("#txtComment").val("");
        $("#modalComment").modal("show");
    }

    this.add = function () {
        var quantity = $("#quantity").val();
        $("#quantity").val(parseInt(quantity) + 1)
    }
    this.delete = function (title, slug, product_id, price_sf, img, tax) {


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
                url: PATH + '/deleteProduct/' + slug,
                method: 'PUT',
                headers: {'X-CSRF-TOKEN': token},
                data: row,
                success: function (data) {
                    $("#quantity").val(data.row.quantity)
                }, error: function (xhr, ajaxOptions, thrownError) {

                }

            })
        } else {
            $("#myModal").modal("show");
        }
    }


    this.redirectProduct = function (url) {
        window.location = PATH + "/productDetail/" + url;
    }


    this.addProductFirestore = function (title, slug, product_id, price, img, tax) {
        var doc_id = '';
        db.collection(user_id).where("product_id", "==", product_id)
                .get()
                .then(function (querySnapshot) {
                    var cont = false;
                    querySnapshot.forEach(function (doc) {
                        if (doc.exists) {
                            cont = true;
                            db.collection(user_id).doc(doc.id).set({
                                quantity: doc.data().quantity + 1,
                                title: title,
                                product_id: product_id,
                                price: price,
                                img: img,
                                tax: tax
                            })
                        }
                    })

                    if (cont == false) {
                        db.collection(user_id).add({
                            title: title,
                            product_id: product_id,
                            price: price,
                            quantity: 1,
                            img: img,
                            tax: tax
                        }).then(function (docRef) {
                            console.log("Document written with ID: ", docRef.id);
                        }).catch(function (error) {
                            console.error("Error adding document: ", error);
                        });
                    }
                })
                .catch(function (error) {
                    console.log("Error getting documents: ", error);
                });
    }

    this.addComment = function () {

        var token = $("input[name=_token]").val();

        var html = "";
        var param = {};
        param.slug = $("#slug").val();
        param.subject = $("#txtTitle").val();
        param.comment = $("#txtComment").val();
        param.answer_id = $("#answer_id").val();

        $.ajax({
            url: PATH + '/addComment',
            method: 'POST',
            headers: {'X-CSRF-TOKEN': token},
            data: param,
            dataType: 'JSON',
            success: function (data) {
                obj.loadTable(data)
                $("#modalComment").modal("hide");
            }
        })

    }


    this.getComment = function () {
        var html = "";
        $.ajax({
            url: PATH + '/getComment/' + $("#slug").val(),
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                obj.loadTable(data);
            }
        })
    }

    this.loadTable = function (data) {
        var html = '';
        data.forEach(function (val, i) {
            html += `
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">${val.subject}</h5>
                        <h6 class="card-subtitle mb-2 text-muted" style="padding:2%">Usuario</h6>
                        <p class="card-text" style="padding:2%">${val.comment}</p>

                    </div>
                    <div class="card-body text-right" style="padding:1%">
                        <a href="#" class="card-link text-right">Me gusta</a>
                        <a href="#" class="card-link text-muted">No me gusta</a>
                        <a href="#" class="card-link text-right" onclick="obj.answer(${val.id}); return false;">Responder</a>
                    </div>
                </div>`
                    ;
        })

        $("#contentComment").html(html);
    }


}

var obj = new detailProduct();
obj.init();
