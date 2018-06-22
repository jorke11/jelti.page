function Detail() {
    var id = 1;
    var param = [];
    var db;
    var user_id;
    this.init = function () {

        $("#main-menu-id").removeClass("img-headers")

        $("[data-toggle=popover]").popover({
            html: true,
            content: function () {
                var id = $(this).attr('id')
                return $('#popover-content').html();
            }
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

//        db = firebase.database().ref();
//        db = firebase.firestore();

//        db.child(user_id).set({id:"prueba"})
//        this.getDataFirebase();

//        this.getDataFireStore();



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

    this.registerClient = function () {
        $("#myModal").modal("show");
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
                if ((data.products).length > 0) {
                    $.each(data.products, function (i, value) {
                        html += `
                            <div class="col-3">
                                            <div class="card text-center">
                                                <img class="card-img-right img-fluid" src="/${value.thumbnail}" alt="Card image cap" 
                                                onclick="obj.redirectProduct('${value.slug}')" 
                                                     style="cursor: pointer;width:60%;position: relative;margin-left: 20%;padding-top: 15px">
                                                <a href="#" class="btn btn-primary btn-sm" style="
                                                   margin-left: 80%;
                                                   border-radius: 10px;
                                                   background-color: #5baf98;
                                                   border: 1px solid #5baf98;
                                                   cursor: pointer;
                                                   margin-right: 5%;"
                                                   onclick="objCounter.addProduct('${value.short_description}',
                                                   '${value.slug}','${value.id}','${value.price_sf}','${value.thumbnail}','${value.tax}'); return false;"
                                                   >
                                                    <svg id="i-plus" viewBox="0 0 32 32" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                    <path d="M16 2 L16 30 M2 16 L30 16" />
                                                    </svg>
                                                </a>
                                                <div class="card-body" style="padding-bottom: 1.25em;padding-top:0">

                                                    <p class="card-title" onclick="obj.redirectProduct('${value.slug}')" 
                                                       style="cursor: pointer;min-height: 60px;margin-bottom: 0;padding-top: 5%" >${value.short_description}</p>
                                                    <p>
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

                                                                                                                                                                                        <!--<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>-->
                                                    `
                        if (user_id == undefined) {
                            html += `<button class="btn btn-info" type="button" onclick="obj.registerClient()">
                                                        Registrate 
                                                    </button>
                                                    `
                        } else {
                            html += `<p>
                                                        $ ${value.price_sf}
                                                        </p>`
                        }
                        html += `  
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
                $.each(data.subcategories, function (i, val) {
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
                if (data.count_cat > 1) {
                    $("#main-image-category").attr("src", PATH + "/images/banner_sf.jpg");
                } else {
                    console.log(data.row_category)
                    $("#main-image-category").attr("src", PATH + "/" + data.row_category.banner);
                }


            }, error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr)
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
            }

        })
    }

}

obj = new Detail();
obj.init();