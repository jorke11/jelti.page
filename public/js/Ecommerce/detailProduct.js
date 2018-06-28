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

        $("#addComment").click(this.addComment);
        $("#AddProduct").click(this.addProduct);
        $("#btnOpenModal").click(this.modalComment);
        $("#contentComment").empty();
        this.getComment();
//        this.getQuantity();
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
//                        console.log(doc.data())
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

    this.getComment = function () {
        var html = "";
        $.ajax({
            url: '../getComment/' + $("#product_id").val(),
            method: 'GET',
            dataType: 'JSON',
            success: function (data) {
                obj.loadTable(data);
            }
        })
    }

    this.loadTable = function (data) {
        var html = '';
        $.each(data, function (i, val) {
            html += `
                        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>${val.title}</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="text-muted">${val.name} ${val.last_name}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="text-muted">${val.created_at}</p>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-lg-12">
                                <p class="text-justify">
                                   ${val.content}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true" style='cursor: pointer;font-size: 25px;'></span>&nbsp;<span class="badge">42</span>&nbsp;&nbsp;
                                <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true" style='cursor: pointer;font-size: 25px'></span>&nbsp;<span class="badge">0</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="glyphicon glyphicon-comment" aria-hidden="true" style='cursor: pointer;font-size: 25px' onclick="obj.modalComment({{$product->id}})"></span>&nbsp;<span class="badge" >0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`
                    ;
        })

        $("#contentComment").html(html);
    }

    this.addComment = function () {
        var html = "";
        var param = {};
        param.product_id = $("#product_id").val();
        param.content = $("#txtComment").val();
        param.title = $("#txtTitle").val();
        $.ajax({
            url: PATH + '/addComment',
            method: 'POST',
            data: param,
            dataType: 'JSON',
            success: function (data) {
                obj.loadTable(data)
                $("#modalComment").modal("hide");
            }
        })

    }
}

var obj = new detailProduct();
obj.init();
