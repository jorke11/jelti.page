function Detail() {
    this.init = function () {
        var html = "";
    }

    this.showContent = function (order_id) {
        var html = ''

        $.ajax({
            url: PATH + '/getDetailOrder/' + order_id,
            method: 'GET',
            success: function (data) {
                data.forEach(function (row, i) {
                    row.thumbnail = (row.thumbnail == null)?'images/product/default_product.jpeg':row.thumbnail;
                            html += `
                            <div class="row">
                                <div class="col-11">
                                    <div class="card">
                                        <div class="card-body" style="padding:2%">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img class="img-fluid"  src="${PATH + "/" + row.thumbnail}" alt="Card image cap" 
                                                    style="max-width: 150%;width:80%;cursor:pointer" 
                                                     onclick="objCounter.redirectProduct('${row.slug}')">
                                                </div>
                                                <div class="col-9">
                                                    <p>${row.product} <br>
                                                    Precio <b>${objCounter.formatNumber(parseInt(row.value))}</b><br>
                                                    Cantidad <b>${row.quantity}</b></p>
                                                    <p>Total: <b>${row.totalFormated_real}</b></p>
                                                </div>
                                            </div>
                                            
                                        </div>
                    
                                    </div>
                                </div>
                            </div>
                            `;
                })

                $("#list_order").html(html)

            }, error: function (xhr, ajaxOptions, thrownError) {
//                toastr.error(xhr.responseJSON.msg);
//                elem.attr("disabled", false);
            }

        })

    }
}

var obj = new Detail();
obj.init();
