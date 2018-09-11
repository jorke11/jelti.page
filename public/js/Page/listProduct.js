function listProduct() {
    var id = 1, flag_category = false, flag_subcategory = false, flag_supplier = false;
    var param = [];
    var db;
    var user_id;
    this.init = function () {
        $("#main-menu-id").removeClass("img-headers")
//        $("[data-toggle=popover]").popover({
//            html: true,
//            content: function () {
//                var id = $(this).attr('id')
//                return $('#popover-content').html();
//            }
//        });
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

//        db = firebase.database().ref();
//        db = firebase.firestore();

//        db.child(user_id).set({id:"prueba"})
//        this.getDataFirebase();

//        this.getDataFireStore();

        $("#main-menu-id").css("background-color", "rgba(0,0,0,0)")
        $('#get-checked-data').on('click', function (event) {
            event.preventDefault();
            var checkedItems = {}, counter = 0;
            $("#check-list-box li.active").each(function (idx, li) {
                checkedItems[counter] = $(li).text();
                counter++;
            });
            $('#display-json').html(JSON.stringify(checkedItems, null, '\t'));
        });
        $('#content-categories .list-group-item .custom-control-label').on('click', function () {
            var checkBox = $(this).prev('input');
            if ($(checkBox).attr('checked'))
                $(checkBox).removeAttr('checked');
            else
                $(checkBox).attr('checked', 'checked');
            return false;
        })

    }

    this.registerClient = function () {
        $("#myModal").modal("show");
    }

    this.getData = function () {
        if (user_id) {
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

    this.getCategories = function () {
        $.ajax({
            url: PATH + '/categories',
            method: 'GET',
            success: function (data) {
                obj.setListCategories(data)
            }, error: function (xhr, ajaxOptions, thrownError) {
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
            }

        })

    }
    this.getSuppliers = function () {
        $.ajax({
            url: PATH + '/suppliers',
            method: 'GET',
            success: function (data) {
                obj.setListSupplier(data)
            }, error: function (xhr, ajaxOptions, thrownError) {
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
            }

        })

    }

    this.getDiet = function () {
        $.ajax({
            url: PATH + '/diet',
            method: 'GET',
            success: function (data) {
                obj.setListDiet(data)
            }, error: function (xhr, ajaxOptions, thrownError) {
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
            }

        })

    }

    this.setListCategories = function (data) {
        $("#content-categories").empty();
        var html = ''
        data.forEach(function (row, i) {
            html += ` <li class="list-group-item pb-0 pt-0">
                            <div class="row" style="cursor:pointer" >
                                <div class="col-12">
                                    <a href="javascript:;" class="list-group-item list-group-item-action" onclick="obj.reloadCategories('${row.slug}', this)";>
                                        <div class="row">
                                            <div class="col-lg-10">
                                                    ${row.description} (${row.subcategories})
                                            </div>
                                            <div class="col-lg-2">
                                                <input type="checkbox" class="form-control list-category" 
                                                    name="categories[]"  value="${row.slug}" id='checkbox_cat_${row.slug}'>
                                            </div>
                                        </div>

                                    </a>
                                </div>
                            </div>
                        </li>`;
        })

        $("#content-categories").html(html);
    }

    this.setListSupplier = function (data) {
        $("#content-supplier").empty();
        var html = ''
        data.forEach(function (val, i) {
            html += ` <li class="list-group-item">
                            <div class="row" style="cursor:pointer" onclick="obj.reloadCategories('${val.id}'); return false;">
                                <div class="col-10">
                                    ${val.business} (${val.products})
                                </div>
                                <div class="col-2">
                                    <input type="checkbox" name="supplier[]" class="form-control" value="${val.id}" id='checkbox_sup_${val.id}'>
                                </div>
                            </div>
                    </li>`;
        })

        $("#content-supplier").html(html);
    }
    this.setListDiet = function (data) {
        $("#content-dietas").empty();
        var html = ''
        data.forEach(function (val, i) {
            html += ` <li class="list-group-item">
                            <div class="row" style="cursor:pointer" onclick="obj.reloadCategories('${val.slug}'); return false;">
                                <div class="col-10">
                                        ${val.description}
                                </div>
                                <div class="col-2">
                                    <input type="checkbox" name="dietas[]" class="form-control" value="${val.slug}" id='checkbox_dieta_${val.slug}'>
                                </div>
                            </div>
                        </li>`;
        })

        $("#content-dietas").html(html);
    }

    this.setData = function (data) {
        $("#badge-quantity").html(data.quantity)

        var html = '';
        if (data.detail != false) {
            data.detail.forEach((row, index) => {

                if (index < 4) {

                    html += `
                            <div class="row mb-3">
                                <div class="col-4">
                                        <img class="img-fluid"  src="${PATH + "/" + row.thumbnail}" alt="Card image cap" >
                                        <img class="img-fluid"  src="${PATH + "/" + row.thumbnail}" alt="Card image cap" >
                                </div>
                                <div class="col-8">
                                    <p>${row.product} <br>
                                    Precio <b>${obj.formatCurrency(parseInt(row.price_sf), "$")}</b><br>
                                    Cantidad <b>${row.quantity}</b></p>
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
        } else {
            $(elem).addClass("title-green")
            $("#title-business").removeClass("title-green");
        }

        id = elem_id;
        $("#type_stakeholder").val(id);
    }

    this.eventCategory = function (ref = null) {
        ref = (ref == null) ? '' : "-" + ref;
        if (flag_category == false) {
            $("#plus-icon" + ref).addClass("d-none");
            $("#minus-icon" + ref).removeClass("d-none");
            flag_category = true;
        } else {

            $("#plus-icon" + ref).removeClass("d-none");
            $("#minus-icon" + ref).addClass("d-none");
            flag_category = false;
    }
    }

    this.reloadCategories = function (slug, e) {

        var data = {};
        var categories = [];
        var cat = "", subcategories = [], supplier = [], dietas = [];

        //        console.log($("#checkbox_cat_" + slug).is(":checked"));
        //        console.log($(e).attr("type"));

        if ($("#checkbox_cat_" + slug).is(":checked")) {
            $("#checkbox_cat_" + slug).prop("checked", false);
        } else {
            $("#checkbox_cat_" + slug).prop("checked", true);
        }

        if ($("#checkbox_subcat_" + slug).is(":checked")) {
            $("#checkbox_subcat_" + slug).prop("checked", false);
        } else {
            $("#checkbox_subcat_" + slug).prop("checked", true);
        }
        if ($("#checkbox_sup_" + slug).is(":checked")) {
            $("#checkbox_sup_" + slug).prop("checked", false);
        } else {
            $("#checkbox_sup_" + slug).prop("checked", true);
        }
        if ($("#checkbox_dieta_" + slug).is(":checked")) {
            $("#checkbox_dieta_" + slug).prop("checked", false);
        } else {
            $("#checkbox_dieta_" + slug).prop("checked", true);
        }

        $("input[name='categories[]']:checked").each(function () {
            cat += (cat == '') ? '' : '&';
            cat += $(this).val();
            categories.push($(this).val());
        });

        $("input[name='subcategories[]']:checked").each(function () {
            subcategories.push($(this).val());
        });

        $("input[name='supplier[]']:checked").each(function () {
            supplier.push($(this).val());
        });
        $("input[name='dietas[]']:checked").each(function () {
            dietas.push($(this).val());
        });

        data.subcategories = subcategories;
        data.categories = categories;
        data.supplier = supplier;
        data.dietas = dietas;

        var html = "";
        $.ajax({
            url: PATH + '/search',
            method: 'get',
            data: data,
            beforeSend: function () {
                $("#loading-super").removeClass("d-none");
            },
            success: function (data) {

                $("#divproducts").empty();
                var cont = 0;
                html += ' <div class="row justify-content-center text-center" style="padding-bottom: 2%">';
                if ((data.products).length > 0) {
                    $.each(data.products, function (i, value) {
                        html += `
                            <div class="col-3">
                                            <div class="card text-center">
                                                <img class="card-img-right img-fluid" src="https://superfuds.com/${value.thumbnail}" alt="Card image cap" 
                                                onclick="obj.redirectProduct('${value.slug}')" 
                                                     style="cursor: pointer;width:60%;position: relative;margin-left: 20%;padding-top: 15px">
                                              
                                                <div class="card-body" style="padding-bottom: 1.25em;padding-top:0">

                                                    <p class="text-left text-supplier" style="margin:0;"><a href="/search/s=${objCounter.slug(value.supplier)}" class="text-muted ">${(value.supplier).toUpperCase()}</a></p>

                                                    <h5 class="card-title text-left title-products" style="margin:0;min-height: 100px" 
                                                        onclick="obj.redirectProduct('${value.slug}')">
                                                            ${((value.short_description).toUpperCase()).substring(0, 50)}
                                                    </h5>           
                        
                        
                                                    <p class="text-left">
                                                        <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                        <svg id="i-star" viewBox="0 0 32 32" width="22" height="22" color="#ffa608" fill="#ffa608" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                                                        </svg>
                                                    </p>
                        `
                        if (user_id == undefined) {
                            html += `<p></p>`
                        } else {
                            html += `<p>
                                                        ${objCounter.formatNumber(value.price_sf_with_tax, "$")}
                                                        </p>`
                        }

                        html += `
                                <div class="row ${(value.quantity) ? '' : 'd-none'}" id="buttonAdd_${value.id}" 
                                     style="background-color: #5cb19a;padding-top: 5%;border-radius: 10px">
                                    <div class="col">
                                        <svg id="i-minus"  class="btn-minus" viewBox="0 0 32 32"  style="cursor:pointer"
                                             stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                             onclick="objCounter.deleteUnit(${value.id},'${value.slug}')">
                                        <path d="M2 16 L30 16" />
                                        </svg>

                                    </div>
                                    <div class="col" >
                                        <span id="quantity_product_${value.id}" style="color:white">${(value.quantity != null) ? value.quantity : 0}</span>
                                    </div>
                                    <div class="col" >
                                        <svg id="i-plus" class="btn-plus" viewBox="0 0 35 35" stroke-linecap="round"  stroke="#ffffff"
                                             stroke-linejoin="round" stroke-width="3" style="cursor:pointer"
                                             onclick="objCounter.addProduct('${value.short_description}',
                                                         '${value.slug}','${value.id}','${value.price_sf}','${value.thumbnail}','${value.tax}'); return false;">
                                        <path d="M16 2 L16 30 M2 16 L30 16" />
                                        </svg>

                                    </div>
                                </div>

                                <button class="btn ${(value.quantity == null) ? '' : 'd-none'}" 
                                        id="btnOption_${value.id}" onclick="objCounter.showButton('${value.short_description}',
                                                    '${value.slug}','${value.id}','${value.price_sf}','${value.thumbnail}','${value.tax}')" 
                                        style="background-color: #5cb19a;color:white">Agregar</button>
                            </div>
                        </div>
                    </div>
                    `

                        cont++;
                        if (cont == 4) {
                            cont = 0;
                            html += `</div>
                                        <div class="row" style="padding-top: 2%;padding-bottom: 2%">
                                            `
                        }

                    })

                    html += `</div>`;
                } else {
                    html += `No se encontraron productos`;
                }


                $("#divproducts").html(html);
                $("#content-subcategories").empty();
                html = "";
                var checked = false;
                $.each(data.subcategories, function (i, val) {
                    checked = (val.checked != undefined) ? 'checked' : '';
                    html += `
                        <li class="list-group-item">
                            <div class="row" onclick=obj.reloadCategories('${val.slug}') style="cursor:pointer">
                                <div class="col-10">
                                    ${val.short_description} (${val.products})
                                </div>
                                <div class="col-2">
                                    <input type="checkbox" ${checked} name="subcategories[]" class="form-control" value="${val.slug}" id='checkbox_subcat_${val.slug}'>
                                </div>
                            </div>
                        </li>`;
                })

                $("#content-subcategories").html(html);

                if ((data.row_category.banner).indexOf("banner_sf.png") == -1) {
                    $("#img-image").removeClass("d-none");
                } else {
                    $("#img-image").addClass("d-none");
                }

                if (data.count_cat > 1) {
                    $("#main-image-category").attr("src", "/images/banner_sf.png");
//                    $("#main-menu-id").addClass("main-menu-out");
                } else {
//                    $("#main-menu-id").removeClass("main-menu-out");
                    $("#main-image-category").attr("src", data.row_category.banner);
                }

                $("#loading-super").addClass("d-none");


            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr)
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
            }

        })
    }



    this.hideButton = function (id) {
        $("#buttonAdd_" + id).addClass("d-none");
        $("#btnOption_" + id).removeClass("d-none");
    }

}

obj = new listProduct();
obj.init();