@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

            @if (session('success'))
                <div class="alert alert-success desva">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger desva">
                    {{ session('error') }}
                </div>
            @endif

            <div id="criterioBusqueda" class="alert alert-danger desva" style="display: none" role="alert">
                Debe seleccionar un criterio de b&uacute;squeda
            </div>

            <form  action="{{ url('/producto') }}" method="GET" role="form" id="form">
                {{ csrf_field() }}
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Criterios de B&uacute;squeda</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="">Producto: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                <input type="text" class="form-control" name="nombre">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="precio">Precio: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                <input type="text" class="form-control" name="precio">
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="form-group col-6">
                                <label for="">Proveedor: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                <input type="text" class="form-control" name="nombres">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="button" name="send" onClick="validar()" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            <a href="{{ url('/producto') }}" type="button" class="btn btn-primary"><i class="fa fa-eye"></i> Ver Todos</a>
                            <button type="reset" class="btn btn-danger"><i class="fa fa-trash"></i> Limpiar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<br>
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ url('producto/create') }}" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Nuevo</a>
                            
                            <button type="button" onClick="reports('pdf')" class="btn btn-outline-primary"><i
                                class="fa fa-file"></i> Pdf
                            </button>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-12">
                            <table id="example2" class="table table-bordered">
                                <thead class="bg-primary">
                                    <tr class="text-center">
                                        <th style="width:60px">N°</th>
                                        <th>Proveedor</th>
                                        <th>Producto</th>
                                        <th>precio</th>
                                        <th style="width:100px">Imagen</th>
                                        <th style="width:180px">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datatable as $items)
                                        <tr class="text-center">
                                            <td>{{ $items->num }}</td>
                                            <td>{{ $items->nombre }}</td>
                                            <td>{{ $items->producto_nombre }}</td>
                                            <td>{{ $items->precio }}</td>
                                            <td></td>
                                            <td>
                                                <div class="row justify-content-center">
                                                    <a title="Editar" href="{{ url('/producto/'.$items->id.'/edit') }}" type="button" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>

                                                    <div>
                                                        <form action="{{ url('/producto/'.$items->id) }}" method="POST" class="formEliminar">
                                                          @method('DELETE')
                                                          @csrf
                                                          <button class="btn btn-danger btn-sm" type="submit" title="Eliminar"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

setTimeout(function() {
    $(".desva").fadeOut(1500);
},3000);
    
function validar() {
    var select = $('#form select').length
    var text = $('#form input[type=text]').length

    var i = 1
    var flag = false

    if(select > 0) {
        $.each($('#form select'), function () {
            if ($(this).val() == '') {
                if (i == select) {
                    flag = false
                    i = 1
                } else {
                    i++
                }
            } else {
                flag = true
            }
        })
    }

    if(text > 0 && !flag) {
        $.each($('#form input[type=text]'), function () {
            if ($(this).val() == '') {
                if (i == text) {
                    flag = false
                }
                i++
            } else {
                flag = true
            }
        })
    }

    if(!flag) {
        $('#criterioBusqueda').show()
        desvanecer()
    } else {
        $("#form").submit()
    }
}

function reports(type) {
    var link = window.location.search
    var inicio = link.indexOf('&')

    if (inicio == -1) {
        cadena = ''
    } else {
        var cadena = link.substring(inicio)
    }

    if (type == 'pdf') {
        window.open('{{ url("/productoPdf") }}' + '?' + cadena, '_blank')
    }
}
</script>
@endsection