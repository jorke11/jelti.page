function Coupon() {
    var token;
    this.init = function () {
        var html = "";
        token = $("input[name=_token]").val();
        this.getCuopon()
    }

    this.applyDiscount = function (coupon_id) {
        var html = ''

        $.ajax({
            url: PATH + '/applyDiscount/' + coupon_id,
            method: 'PUT',
            headers: {'X-CSRF-TOKEN': token},
            success: function (data) {
                if (data.status == true) {
                    toastr.success(data.msg);
                    $("#tableCoupon tbody").empty()
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
            }

        })
    }

    this.getCuopon = function () {
        var html = '';

        $.ajax({
            url: PATH + '/getCoupon',
            method: 'get',
            headers: {'X-CSRF-TOKEN': token},
            success: function (data) {
                if (data.created_at != undefined) {
                    html = `
                      <tr>
                        <td>${data.created_at}</td>
                        <td>${$.formatNumber(data.amount)}</td>
                        <td><button class="btn btn-outline-success btn-sm" type="button" onclick=obj.applyDiscount(${data.id})>
                                <svg id="i-checkmark" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M2 20 L12 28 30 4" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                `;
                    $("#tableCoupon tbody").html(html);
                }

            }, error: function (xhr, ajaxOptions, thrownError) {
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
            }

        })
    }
}

var obj = new Coupon();
obj.init();
