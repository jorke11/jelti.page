function Page() {
    var id = 1;
    this.init = function () {
        $(window).scroll(function () {

            if ($(this).scrollTop() > 0) {
//                $("#main-menu-id").removeClass("main-menu", 800).fadeIn(1000);
                $("#main-menu-id").animate({
                    paddingTop: '0px'
                });

//                $("#slider-main").removeClass("main-slider", 800).fadeIn(1000);
                $("#slider-main").animate({
                    paddingTop: '0px'
                });

                $('.go-top').slideDown(300);
            } else {
                
                $("#main-menu-id").animate({
                    paddingTop: '100px'
                });


                $("#slider-main").animate({
                    paddingTop: '160px'
                });

                $('.go-top').slideUp(300);
            }
        });
        $('.go-top').click(function () {
//            $("#main-menu-id").addClass("main-menu", {duration: 800});
//            $("#slider-main").addClass("main-slider", {duration: 000});
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


//        $(".test").smoove({
//            offset: '15%',
//            // moveX is overridden to -200px for ".bar" object
//            moveX: '100px',
//            moveY: '100px',
//        });



        $('.list-group.checked-list-box .list-group-item').each(function () {

            // Settings
            var $widget = $(this),
                    $checkbox = $('<input type="checkbox" class="hidden" />'),
                    color = ($widget.data('color') ? $widget.data('color') : "primary"),
                    style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
                    settings = {
                        on: {
                            icon: 'glyphicon glyphicon-check'
                        },
                        off: {
                            icon: 'glyphicon glyphicon-unchecked'
                        }
                    };

            $widget.css('cursor', 'pointer')
            $widget.append($checkbox);

            // Event Handlers
            $widget.on('click', function () {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
                $checkbox.triggerHandler('change');
                updateDisplay();
            });
            $checkbox.on('change', function () {
                updateDisplay();
            });


            // Actions
            function updateDisplay() {
                var isChecked = $checkbox.is(':checked');

                // Set the button's state
                $widget.data('state', (isChecked) ? "on" : "off");

                // Set the button's icon
                $widget.find('.state-icon')
                        .removeClass()
                        .addClass('state-icon ' + settings[$widget.data('state')].icon);

                // Update the button's color
                if (isChecked) {
                    $widget.addClass(style + color + ' active');
                } else {
                    $widget.removeClass(style + color + ' active');
                }
            }

            // Initialization
            function init() {

                if ($widget.data('checked') == true) {
                    $checkbox.prop('checked', !$checkbox.is(':checked'));
                }

                updateDisplay();

                // Inject the icon if applicable
                if ($widget.find('.state-icon').length == 0) {
                    $widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
                }
            }
            init();
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

}

objPage = new Page();
objPage.init();