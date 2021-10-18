<html>
<head>
    <link rel="stylesheet" href="css/pdf.css">
</head>
<body>

<table class="table">
    <tbody>
        <tr>

            <td class="text-left" style="width: 30%"><img src="{{ public_path('/img/edcnetwork_logo.jpg') }}" height="48px" alt=""></td>
            <td class="text-center" style="width: 60%; font-size:12pt"><b>Listado de productos</b></td>

            <td class="text-right" style="width: 30%; font-size:7pt">
                <span>Realizado por: {{ Auth::user()->name }}</span>
                <br>
                <spanp>{{ \Carbon\Carbon::now()->format('d/m/Y h:m:s') }}</spanp>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-center" style="vertical-align: center">
                <b>PRODUCTOS</b>
            </td>
        </tr>
    </tbody>
</table>

<table class="table table-bordered table-sm">
    <thead>
        <tr class="text-center" style="font-size:9pt">
            <th style="width: 8%">N°</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>IMAGÉN</th>
            <th>PROVEEDOR</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datatable as $items)
            <tr class="text-center" style="font-size:7pt">
                <td> {{$items->num}} </td>
                <td> {{$items->producto_nombre}} </td>
                <td> {{$items->precio}} </td>
                <td>  </td>
                <td> {{$items->nombre}} </td>
            </tr>
        @endforeach-
    </tbody>
</table>

</body>
</html>
