<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante</title>
    <style>
        #detail th {     
            font-size: 18px;     
            font-weight: normal;     
            padding: 8px;
            background: #00b065;
            border-top: 4px solid #00b065;    
            border-bottom: 1px solid #fff; color: #fff; 
        }
    </style>
</head>
<body>

    <table align='left'  width='100%' id="detail">
        <thead>
            <tr>
                <th colspan="2">Resultados de la operación</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>Empresa</td>
                    <td>Superfuds S.A.S</td>
                </tr>
                <tr>
                    <td>Nit</td>
                    <td>900703907-7</td>
                </tr>
                <tr>
                    <td>Fecha</td>
                    <td>{{date("d-m-Y")}}</td>
                </tr>
                <tr>
                    <td>Estado</td>
                    <td>{{$data["state"]}}</td>
                </tr>
                <tr>
                    <td>Referencia de pedido</td>
                    <td>{{$data["referenceCode"]}}</td>
                </tr>
                <tr>
                    <td>Referencia de Transacción</td>
                    <td>{{$data["transactionId"]}}</td>
                </tr>
                <tr>
                    <td>Número Transacción / CUS</td>
                    <td>{{$data["cus"]}}</td>
                </tr>
                <tr>
                    <td>Banco</td>
                    <td>{{$data["pseBank"]}}</td>
                </tr>
                <tr>
                    <td>Valor</td>
                    <td>{{$data["TX_VALUE"]}}</td>
                </tr>
                <tr>
                    <td>Moneda</td>
                    <td>{{$data["currency"]}}</td>
                </tr>
                <tr>
                    <td>Descripción</td>
                    <td>{{$data["description"]}}</td>
                </tr>
                <tr>
                    <td>Ip origin</td>
                    <td>{{$data["pseReference1"]}}</td>
                </tr>
        </tbody>
    </table>
</body>
</html>