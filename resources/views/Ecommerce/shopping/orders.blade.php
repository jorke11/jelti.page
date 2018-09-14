@extends('layouts.page')
@section('content')
<div class="container-fluid">
    <div class="row" style="padding-bottom: 1%;padding-top: 5%">
        <div class="col-6 offset-1">
            <h2>Tus pedidos</h2>
        </div>
    </div>

    <div class="row" style="padding-bottom: 2%;">
        <div class="col-6 ">
            <table class="table table-bordered  table-condensed" id="orderClient">
                <thead>
                    <tr>
                        <th>Orden</th>
                        <th>Factura</th>
                        <th>Fecha</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $val)
                    <tr>
                        <td>Orden #{{$val->id}}</td>
                        <td>Factura #{{$val->invoice}}</td>
                        <td>{{date("Y-m-d",strtotime($val->dispatched))}}</td>
                        <td>{{$val->subtotal}}</td>
                        <td>{{$val->total}}</td>
                        <td>Ver mas <button class="btn btn-outline-success btn-sm" type="button" onclick=obj.showContent({{$val->invoice}})>
                                <svg id="i-chevron-right" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M12 30 L24 16 12 2" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
        <div class="col-6">
            <div id="list_order">

            </div>
        </div>
    </div>
</div>
{!!Html::script('js/Ecommerce/Orders.js')!!}
@endsection