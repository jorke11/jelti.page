function Page() {
    var id = 1;
    var param = [];
    var db;
    var user_id;
    this.init = function () {
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
//
//        firebase.initializeApp(config);

//        db = firebase.database().ref();
//        db = firebase.firestore();

//        db.child(user_id).set({id:"prueba"})
//        this.getDataFirebase();
//        this.getDataFireStore();
        this.getData();




        $('#get-checked-data').on('click', function (event) {
            event.preventDefault();
            var checkedItems = {}, counter = 0;
            $("#check-list-box li.active").each(function (idx, li) {
                checkedItems[counter] = $(li).text();
                counter++;
            });
            $('#display-json').html(JSON.stringify(checkedItems, null, '\t'));
        });

    }

    this.registerClient = function () {
        $("#myModal").modal("show");
    }


    this.getData = function () {

        if (user_id != undefined) {
            $.ajax({
                url: PATH + '/getCounter',
                method: 'GET',
                success: function (data) {
                    obj.setData(data);

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

                if (index < 4) {

                    html += `
                            <div class="row mb-3">
                                <div class="card">
                                    <div class="card-body" style="padding:5%">
                                        <div class="row">
                                            <div class="col-4">
                                                    <img class="img-fluid"  src="${row.thumbnail}" alt="Card image cap" style="max-width: 160%;">
                                            </div>
                                            <div class="col-8">
                                                <p>${row.product} <br>
                                                Precio <b>${obj.formatCurrency(parseInt(row.price_sf), "$")}</b><br>
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

    this.getDataFirebase = function () {

        if (user_id != undefined) {

            db.child(user_id).on("value", function (snapshots) {
                var quantity = 0, html = "";
                snapshots.forEach(doc => {

                    html += `
                            <div class="row mb-3">
                                <div class="col-4">
                                        <img class="img-fluid"  src="${doc.val().img}" alt="Card image cap" >
                                </div>
                                <div class="col-8">
                                    <p>${doc.val().title} <br>
                                    Precio <b>${obj.formatCurrency(parseInt(doc.val().price), "$")}</b><br>
                                    Cantidad <b>${doc.val().quantity}</b></p>
                                </div>
                            </div>
                            `;

                    quantity += doc.val().quantity;
                });

                $("#badge-quantity").html(quantity)
                $("#popover-content").html(html);
            });
        }
    }


    this.getDataFireStore = function () {


        if (user_id != undefined) {

            db.collection(user_id)
//                .where("state", "==", "CA")
                    .onSnapshot(function (querySnapshot) {

                        $("#popover-content").empty();

                        var data = [], html = '', quantity = 0;
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

    }

    this.formatCurrency = function (n, currency) {
        return currency + " " + n.toFixed(2).replace(/./g, function (c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
        });
    }

//    this.addProduct = function (title, slug, product_id, price, img, tax) {
//        var doc_id = '';
//        var refData = db.child(user_id).child(product_id);
//        var quantity = 1;
//        var param =
//                {
//                    quantity: quantity,
//                    title: title,
//                    product_id: product_id,
//                    price: price,
//                    img: img,
//                    tax: tax
//                };
//
//        refData.on("value", function (snapshot) {
//            if (snapshot.exists()) {
//                param =
//                        {
//                            quantity: snapshot.val().quantity + 1,
//                            title: title,
//                            product_id: product_id,
//                            price: price,
//                            img: img,
//                            tax: tax
//                        };
//                
//                console.log(snapshot.key())
//
////                snapshot.ref().update(param)
////                db.update(updates);
////                refData.update(param);
////                refData.set(param)
////                refData.update({quantity: quantity});
////                obj.updateFirebase(param, snapshot.val());
//            } else {
//                obj.newRecord(param);
//
//            }
//        })
//    }

    this.newRecord = function (obj) {
        var refData = db.child(user_id).child(obj.product_id);
        refData.set(obj);
    }

    this.updateFirebase = function (param, data) {
        var refData = db.child(user_id).child(param.product_id);
        var quantity = data.quantity + 1;
        param.quantity = quantity;

        refData.set(param);
    }

    this.addProductStore = function (title, slug, product_id, price, img, tax) {
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






    this.redirectProduct = function (url) {
        window.location = PATH + "/productDetail/" + url;
    }

    this.openModal = function (modal) {
        $("#" + modal).modal("show");
    }

    this.search = function () {
//        location.href = PATH + "/search/" + $("#formSearch #search").val();
        $("#formSearch").submit();
    }

    this.stakeholder = function (elem_id, elem) {
        elem_id = elem_id | 1;

        if (elem_id == 1) {
            $(elem).addClass("title-green")
            $("#title-supplier").removeClass("title-green");
            $("#field_make").addClass("d-none")
            $("#what_make").removeAttr("required")
        } else {
            $("#field_make").removeClass("d-none")
            $("#what_make").attr("required", "required")
            $(elem).addClass("title-green")
            $("#title-business").removeClass("title-green");
        }

        id = elem_id;
        $("#type_stakeholder").val(id);
    }

    this.reloadCategories = function (slug) {
        var data = {};

        var categories = [];
        var cat = "", subcategories = [];
        $("input[name='categories[]']:checked").each(function () {
            cat += (cat == '') ? '' : '&';
            cat += $(this).val();
            categories.push($(this).val());
        })



        $("input[name='subcategories[]']:checked").each(function () {
            subcategories.push($(this).val());
        })

        data.subcategories = subcategories;
        data.categories = categories;

        var html = "";

        $.ajax({
            url: PATH + '/search',
            method: 'get',
            data: data,
            success: function (data) {

                $("#divproducts").empty();
                var cont = 0;
                html += ' <div class="row justify-content-center text-center" style="padding-bottom: 2%">';
                $.each(data.products, function (i, value) {
                    html += `
                     <div class="col-3 text-center">
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="/${value.thumbnail}" alt="Card image cap" onclick="obj.redirectProduct('${value.slug}')">
                                    <div class="card-body">
                                        <h5 class="card-title" style="min-height:60px">${value.short_description}</h5>
                                        <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                                        <a href="/productDetail/${value.slug}" class="btn btn-primary">Comprar</a>
                                    </div>
                                </div>
                    </div>
                    `;

                    cont++;
                    if (cont == 4) {
                        cont = 0;
                        html += `    
                            </div>
                            <div class="row" style="padding-top: 2%;padding-bottom: 2%">
                                `;
                    }

                })
                html += `</div>`;

                $("#divproducts").html(html);

                $("#content-subcategories").empty();
                html = "";
                $.each(data.categories, function (i, val) {
                    html += `
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-10">
                                    ${val.short_description}
                                </div>
                                <div class="col-2">
                                    <input type="checkbox" name="subcategories[]" class="form-control" value="${val.slug}" onclick=obj.reloadCategories('${val.slug}')>
                                </div>
                            </div>
                        </li>`;
                })


                $("#content-subcategories").html(html);


            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr)
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
            }

        })
    }

}

obj = new Page();
obj.init();