<html>
    <head>
        <link rel="stylesheet" href="css/app.css">
    </head>
<body>

<table class="table">
    <tbody>
        <tr>
            <td colspan="3" class="text-center" style="vertical-align: center">
                <b>PROVEEDORES</b>
            </td>
        </tr>
    </tbody>
</table>

<table class="table table-bordered table-sm">
    <thead>
        <tr class="text-center" style="font-size:9pt">
            <th style="width: 8%">N°</th>
            <th>NOMBRE</th>
            <th>CORREO</th>
            <th>EDAD</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $items)
            <tr class="text-center" style="font-size:7pt">
                <td> {{$items->num}} </td>
                <td> {{$items->nombre}} </td>
                <td> {{$items->correo}} </td>
                <td> {{$items->edad}} </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
