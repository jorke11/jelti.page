<table>
    <tr>
        <td>Hola {{$name}} </td>
    </tr>
    <tr>
        <td>Te damos la mas cordial bienvenida a nuestra plataforma de Compras Superfuds</td>
    </tr>
    <tr>
        <td>Para Activar tu cuenta click en</td><td><a href="{{url("user/activation",$link)}}">{{url("user/activation",$link)}}</a></td>
    </tr>
    <tr>
        <td>Usuario</td><td>{{$email}}</td>
    </tr>
    <tr>
        <td>Celular</td><td>{{$phone_contact}}</td>
    </tr>
</table>




