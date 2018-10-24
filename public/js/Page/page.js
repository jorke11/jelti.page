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

        this.getData();
        this.getDiets();
        this.getBestSeller();




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

                }

            })
        }
    }

    this.getDiets = function () {

        $.ajax({
            url: PATH + '/card-diets',
            method: 'GET',
            success: function (data) {
                obj.setDataDiets(data);
            }, error: function (xhr, ajaxOptions, thrownError) {
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
            }

        })
    }
    this.getBestSeller = function () {

        $.ajax({
            url: PATH + '/best-seller',
            method: 'GET',
            success: function (data) {
                obj.setBestSeller(data, "quantity_most_product_");
            }, error: function (xhr, ajaxOptions, thrownError) {
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
            }

        })
    }

    this.setDataDiets = function (data) {


        var html = `<div class="container-fluid">
                
                    <div class="row row-card">
                        <div class="col-lg-12 col-xs-12">
                            <p class="text-center title-color">Conoce Nuestras Dietas</p>
                        </div>
                    </div>
                
                    <div class="row justify-content-center">
                        <div class="col-10">
                            `;
        if (data != false) {
            data.forEach((row, index) => {
                html += `<div class="row">`;
                row.forEach((val, i) => {
                    let {image, description, search} = val;
                    html += `
                           <div class='col-lg-4 col-xs-6 col-md-6 '>
                                             <div class="card">
                                                <img class="card-img-top" 
                                                     src=${image}
                                                     alt=${description}
                                                     />
                                                <div class="card-body">
                                                    <h2 class="card-title text-center title-diet" >${description}</h2>
                                                    <p class="text-center justify-content-center"><a href='/search/c=${search}' class="link-green">Ver todos</a></p>
                                                </div>
                                            </div>
                                        </div>
                            `;
                })

                html += `</div>`;
            })
            html += `   
                     
                        </div>
                            </div>
                                </div>`
        }

        $("#divDiets").html(html);

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

    this.setBestSeller = function (data, input_id) {
        var html = "";
        data.forEach((row, index) => {
            html += `
            <div class="carousel-item ${(index == 0) ? 'active' : ''}" style="padding: 2%;">
                <div class="row text-center">`
            row.forEach((value, i) => {
                html +=
                        `
                        <div class="col-lg-3 col-xs-4 col-md-3 col-6">
                                <div class="card" >
                                    <img class="card-img-top card-img-product" src="/${value.thumbnail}" alt="Card image cap" 
                                            onclick="objCounter.redirectProduct('${value.slug}')">
                                                <div class="card-body text-center">

                                                    <p class="text-left text-muted " style="margin:0;" >
                                                        <a href="/search/s=${value.slug_supplier}" class="text-supplier">
                                                            ${value.supplier}
                                                        </a>        
                                                    </p>
                                                    <h5 class="card-title text-left title-products" onclick="objCounter.redirectProduct('${value.slug}')">
                                                        ${value.title_ec}
                                                    </h5>
                                                    <p class="text-left">
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" class="star" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                    </p>

                                                    
                                                    <p class="text-left">
                                                        ${(value.price_sf_with_tax == undefined) ? '' : $.formatNumber(value.price_sf_with_tax)}
                                                    </p>
                                                    
                                                                                                                                                                                                                                                                                                                                                                                                                                                         <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                                                    <div class="row row-center ${(value.quantity_order != null) ? '' : 'd-none'}" id="buttonAdd_${value.id}" >
                                                        <div class="col-lg-6">
                                                            <div class="row" style="background-color: #5cb19a;color:white;padding-bottom: 2%;padding-top: 5%;
                                                                 padding-left: 0;padding-right: 0;border-radius: 10px;">
                                                                <div class="col-lg-4 col-4" style="padding-left: 0;padding-right: 0">
                                                                    <svg id="i-minus" class="btn-minus-card-product" viewBox="0 0 32 32"  fill="white"  style="cursor:pointer;"
                                                                         stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                                                                         onclick=objCounter.deleteUnit(${value.id},'${value.slug}','${input_id + value.id}')>
                                                                    <path d="M2 16 L30 16" />
                                                                    </svg>
                                                                </div>
                                                                <div class="col-lg-4 col-4" style="padding-left: 0;padding-right: 0">
                                                                    <input type="text" id="${input_id + value.id}" class="input-quantity-product input-number" 
                                                                        value="${(value.quantity_order != null) ? value.quantity_order : 0}"
                                                                           onkeypress=objCounter.addProductEnter(event,${value.id},'${value.slug}',this)>
                                                                </div>
                                                                <div class="col-lg-4 col-4" style="padding-left: 0;padding-right: 0">
                                                                    <svg id="i-plus" class="btn-minus-card-product" viewBox="0 0 35 35" fill="white" stroke="#ffffff" 
                                                                         stroke-linecap="round" stroke-linejoin="round" stroke-width="4" style="cursor:pointer"
                                                                         onclick="objCounter.addProduct('${value.id}','${value.slug}','${input_id + value.id}'); return false;">
                                                                    <path d="M16 2 L16 30 M2 16 L30 16" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2" style="margin-left: 3px">
                                                            <div class="row icon-ok" style="background-color: #5cb19a;color:white;padding-bottom: 15%;padding-top: 40%;
                                                                 padding-left: 0;padding-right: 0;border-radius: 10px;">
                                                                <div class="col-lg-6">
                                                                    <svg id="i-checkmark" viewBox="0 0 32 32" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" 
                                                                         stroke-linejoin="round" stroke-width="4"
                                                                         style="cursor:pointer"
                                                                         onclick="objCounter.addProductCheck('{${value.short_description}',
                                                                         '${value.slug}','${value.id}','${value.price_sf}}','${value.thumbnail}','${value.tax}','${input_id + value.id}'); return false;"
                                                                         >
                                                                    <path d="M2 20 L12 28 30 4" />
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button style="background-color: #5cb19a;color:white" class="btn ${(value.quantity_order != null) ? 'd-none' : '' }" 
                                                            id="btnOption_${value.id}" onclick="objCounter.showButton('${value.id}','${value.slug}','quantity_best_product_${value.id}')">Agregar</button>
                                                </div>
                                            </div>
                                        </div>
                    `
            })
            html += `
                </div>
            </div>
            `;
        })

        $("#content-best-seller").html(html);
    }

//    this.getDataFirebase = function () {
//
//        if (user_id != undefined) {
//
//            db.child(user_id).on("value", function (snapshots) {
//                var quantity = 0, html = "";
//                snapshots.forEach(doc => {
//
//                    html += `
//                            <div class="row mb-3">
//                                <div class="col-4">
//                                        <img class="img-fluid"  src="${doc.val().img}" alt="Card image cap" >
//                                </div>
//                                <div class="col-8">
//                                    <p>${doc.val().title} <br>
//                                    Precio <b>${obj.formatCurrency(parseInt(doc.val().price), "$")}</b><br>
//                                    Cantidad <b>${doc.val().quantity}</b></p>
//                                </div>
//                            </div>
//                            `;
//
//                    quantity += doc.val().quantity;
//                });
//
//                $("#badge-quantity").html(quantity)
//                $("#popover-content").html(html);
//            });
//        }
//    }


//    this.getDataFireStore = function () {
//
//
//        if (user_id != undefined) {
//
//            db.collection(user_id)
////                .where("state", "==", "CA")
//                    .onSnapshot(function (querySnapshot) {
//
//                        $("#popover-content").empty();
//
//                        var data = [], html = '', quantity = 0;
//                        querySnapshot.forEach(function (doc) {
//
//                            html += `
//                            <div class="row mb-3">
//                                <div class="col-4">
//                                        <img class="img-fluid"  src="${doc.data().img}" alt="Card image cap" >
//                                </div>
//                                <div class="col-8">
//                                    <p>${doc.data().title} <br>
//                                    Precio <b>${obj.formatCurrency(parseInt(doc.data().price), "$")}</b><br>
//                                    Cantidad <b>${doc.data().quantity}</b></p>
//                                </div>
//                            </div>
//                            `;
//                            quantity += doc.data().quantity;
//                            data.push({title: doc.data().title, img: doc.data().img});
//                        });
//
//                        html += ` <div class="row">
//                                <div class="col-12">
//                                     <form action="/payment" method="GET">
//                                        <button class="btn btn-outline-success my-2 my-sm-0 btn-sm form-control" type="submit">Checkout</button>
//                                    </form>
//                                <div>   
//                            </div>`
//
//                        $("#badge-quantity").html(quantity)
//                        $("#popover-content").html(html);
//                    });
//        }
//
//    }

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
                                    <img class="card-img-top img-fluid" src="/${value.thumbnail}" alt="Card image cap" onclick="objCounter.redirectProduct('${value.slug}')">
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