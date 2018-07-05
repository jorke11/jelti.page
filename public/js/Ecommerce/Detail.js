function Detail() {
    this.init = function () {
        var html = "";
    }

    this.showContent = function (order_id) {
        $.ajax({
            url: PATH + '/getDetailOrder/' + order_id,
            method: 'GET',
            success: function (data) {
                console.log(data)

            }, error: function (xhr, ajaxOptions, thrownError) {
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
            }

        })

    }
}

var obj = new Detail();
obj.init();
