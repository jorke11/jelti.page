function Page() {
    var id = 1;
    var param = [];
    this.init = function () {
        $(window).scroll(function () {

            if ($(this).scrollTop() > 0) {
                $("#main-menu-id").removeClass("main-menu").addClass("main-menu-out");
//                $("#slider-main").removeClass("main-slider");
                $('.go-top').slideDown(300);
            } else {
                $("#main-menu-id").addClass("main-menu").removeClass("main-menu-out");
//                $("#slider-main").addClass("main-slider");

                $('.go-top').slideUp(300);

            }
        });
        $('.go-top').click(function () {
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        });



        $('.input-number').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $(".box-client").addClass("back-green");
        $("#type_stakeholder").val(id);
        $("#register").click(function () {
            var elem = $(this);
            elem.attr("disabled", true);
            toastr.remove();
            if (!$("#agree").is(":checked")) {
                toastr.error("Necesita estar de acuerdo con los terminos Legales");
                elem.attr("disabled", false);
                return false;
            }

            if (isNaN($("#phone").val()) != false) {
                toastr.error("Numero de telefono");
                elem.attr("disabled", false);
                return false;
            }

            var form = $("#frm");


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
        });

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
            $(".box-supplier").removeClass("back-green")
            $(elem).addClass("back-green");
        } else {
            $(".box-client").removeClass("back-green")
            $(elem).addClass("back-green");
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