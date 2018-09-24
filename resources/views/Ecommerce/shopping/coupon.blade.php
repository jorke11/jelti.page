@extends('layouts.page')
@section('content')
<div class="container-fluid">


    <div class="row" style="padding-top: 5%">
        <div class="col-6 offset-1">
            <h2>Cupones</h2>
        </div>
    </div>
    <div class="row" style="padding-bottom: 1%;">
        <div class="col-6 offset-1">
            <table class="table table-bordered  table-condensed" id="tableCoupon">
                <thead>
                    <tr>
                        <th>Fecha asignado</th>
                        <th>Total</th>
                        <th>Aplicar descuento</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
</div>
{!!Html::script('js/Ecommerce/Coupon.js')!!}
@endsection