<html>
    <head>
        <link href="css/pdf.css" rel="stylesheet">
        </link>
    </head>
    <body>
        <table class="table">
            <tbody>
                <tr>
                    <td class="text-left" style="width: 30%">
                        <img alt="" height="48px" src="{{ public_path('/img/edcnetwork_logo.jpg') }}"/>
                    </td>
                    <td class="text-center" style="width: 60%; font-size:12pt">
                        <b>
                            Listado de productos
                        </b>
                    </td>
                    <td class="text-right" style="width: 30%; font-size:7pt">
                        <span>
                            Realizado por: {{ Auth::user()->name }}
                        </span>
                        <br>
                            <spanp>
                                {{ \Carbon\Carbon::now()->format('d/m/Y h:m:s') }}
                            </spanp>
                        </br>
                    </td>
                </tr>
                <tr>
                    <td class="text-center" colspan="3" style="vertical-align: center">
                        <b>
                            PRODUCTOS
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-sm">
            <thead>
                <tr class="text-center" style="font-size:9pt">
                    <th style="width: 8%">
                        N°
                    </th>
                    <th>
                        PRODUCTOS
                    </th>
                    <th>
                        PRECIO
                    </th>
                    <th>
                        IMAGÉN
                    </th>
                    <th>
                        PROVEEDORES
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datatable as $items)
                <tr class="text-center" style="font-size:7pt">
                    <td>
                        {{$items->num}}
                    </td>
                    <td>
                        {{$items->producto_nombre}}
                    </td>
                    <td>
                        {{$items->precio}}
                    </td>
                    <td>
                        <img alt="imagen" class="img-thumbnail justify-content-center" src="{{ public_path( $items->url) }}" style="height:100px;"/>
                    </td>
                    <td>
                        {{$items->nombre}}
                    </td>
                </tr>
                @endforeach-
            </tbody>
        </table>
    </body>
</html>
