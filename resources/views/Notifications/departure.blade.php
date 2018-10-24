<html>
    <head>
        <title>Order</title>
        <style type="text/css">
            .detail {font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;font-size: 12px;border-collapse: collapse;}
            .detail th {font-size: 13px;font-weight: normal;padding: 8px;background: #00b065;border-top: 4px solid #aabcfe;border-bottom: 1px solid #fff; color: #039;color:white;}
            .detail tbody td {padding: 8px;background: #f9f9f9;border-bottom: 1px solid #fff;color: #669;border-top: 1px solid transparent;}
            .footer tbody td {padding: 8px;background: white;border-bottom: 1px solid #fff;color: #669;border-top: 1px solid transparent;}
        </style>
    </head>

    <body>
        @if($environment=='local')
        <table align="center" width="850" align="center" id="main"  border="0" cellspacing="0"cellpadding="0">
            <tr align='center'>
                <td colspan="7" style="color:red"><h1>Testing Developer</h1></td>
            </tr>
        </table>
        @endif
        @if($status_id==1)
        <table align="center" width="850" align="center" id="main"  border="0" cellspacing="0"cellpadding="0" style="background-color:red;">
            <tr align='center'>
                <td colspan="7" style="color:white;vertical-align:bottom;padding-bottom: 10px;padding-top: 30px;" valign="middle"><h3>El Pedido fue generado pero no se podra facturar porque el cliente tiene pendientes en cartera, por favor solucionar pago con cliente para que pueda ser despachado</h3></td>
            </tr>
        </table>
        @endif
        <table align="center" width="850" align="center" id="main"  border="0" cellspacing="0"cellpadding="0">
            <tr>
                <td width='15%'><img src="{!!asset('assets/images/logo.png')!!}" width="45" style="display:block"></td>
                <td width='60%'>¡Hola! Feliz día</td>
                <td><strong>Solicitud {!!(isset($id))?$id:0!!}</strong><br> <strong>{{$created_at}}</strong></td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td colspan="2">Se generó una peticion por parte de <b>{{(isset($name))?$name:''}} {{(isset($last_name))?$last_name:''}} 
                </td>
            </tr>
        </table>
        <br>
        <table class="detail" align="center" width="850" align="center" id="main"  border="0" cellspacing="0"cellpadding="0">
            <thead>
                <tr>
                    <th>EAN</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Embalaje</th>
                    <th>Total(units)</th>
                    <th>Valor Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($detail))
                @foreach($detail as $val)
                <tr>
                    <td>{{$val->bar_code}}</td>
                    <td>{{$val->product}}</td>
                    <td>{{$val->quantity}}</td>
                    <td>{{$val->units_sf}}</td>
                    <td>{{$val->units_sf * $val->quantity}}</td>
                    <td>{{$val->valueFormated}}</td>
                    <td>{{$val->totalFormated}}</td>
                </tr>

                @endforeach
                @if($flete != 0)
                <tr>
                    <td colspan="4"</td>
                    <td colspan="2"><b>Flete</b></td>
                    <td>{{"$" . number_format($flete, 0, ",", ".")}}</td>
                </tr>
                @endif
                <tr>
                    <td colspan="4"</td>
                    <td colspan="2"><b>SubTotal</b></td>
                    <td>{{(isset($subtotal))?$subtotal:0}}</td>
                </tr>

                @if($tax5!=0)
                <tr>
                    <td colspan="4"</td>
                    <td colspan="2"><b>Iva 5%</b></td>
                    <td>{{"$" . number_format($tax5, 0, ",", ".")}}</td>
                </tr>
                @endif
                @if($tax19!=0)
                <tr>
                    <td colspan="4"</td>
                    <td colspan="2"><b>Iva 19%</b></td>
                    <td>{{"$" . number_format($tax19, 0, ",", ".")}}</td>
                </tr>
                @endif

                @if($discount > 0)
                <tr>
                    <td colspan="4"</td>
                    <td colspan="2"><b>Descuento</b></td>
                    <td>{{"$" . number_format($discount, 0, ",", ".")}}</td>
                </tr>
                @endif

                <tr>
                    <td colspan="4"></td>
                    <td colspan="2"><b>Total</b></td>
                    <td>{{(isset($total))?$total:0}}</td>
                </tr>
                @endif
                </body>
        </table>
        <table class="footer" align="center" width="850" align="center" id="main"  border="0" cellspacing="0"cellpadding="0">
            <tr>
                <td width="20%">Bodega Salida</td>
                <td> {!!(isset($warehouse))?$warehouse:''!!}</td>
                <td colspan="5"></td>
            </tr>
            <tr>
                <td>Saludos</td>
            </tr>
        </table>
    </body>
</html>

