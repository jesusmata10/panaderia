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
            <div class="alert alert-danger desva" id="criterioBusqueda" role="alert" style="display: none">
                Debe seleccionar un criterio de búsqueda
            </div>
            <form action="{{ url('/producto') }}" id="form" method="GET" role="form">
                {{ csrf_field() }}
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-bold">
                            Criterios de Búsqueda
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="">
                                    Producto:
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-hashtag">
                                            </i>
                                        </span>
                                    </div>
                                    <input class="form-control" name="nombre" type="text">
                                    </input>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="precio">
                                    Precio:
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-hashtag">
                                            </i>
                                        </span>
                                    </div>
                                    <input class="form-control" name="precio" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="">
                                    Proveedor:
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-hashtag">
                                            </i>
                                        </span>
                                    </div>
                                    <input class="form-control" name="nombres" type="text">
                                    </input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button class="btn btn-primary" name="send" onclick="validar()" type="button">
                                <i class="fa fa-search">
                                </i>
                                Buscar
                            </button>
                            <a class="btn btn-primary" href="{{ url('/producto') }}" type="button">
                                <i class="fa fa-eye">
                                </i>
                                Ver Todos
                            </a>
                            <button class="btn btn-danger" type="reset">
                                <i class="fa fa-trash">
                                </i>
                                Limpiar
                            </button>
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
                                <a class="btn btn-primary" href="{{ url('producto/create') }}" type="button">
                                    <i class="fa fa-plus">
                                    </i>
                                    Nuevo
                                </a>
                                <button class="btn btn-secondary" onclick="reports('pdf')" type="button">
                                    <i class="fa fa-file">
                                    </i>
                                    Pdf
                                </button>
                            </div>
                        </div>
                        <br>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-responsive-lg table-striped" id="">
                                        <thead class="bg-primary">
                                            <tr class="text-center">
                                                <th style="width:60px">
                                                    N°
                                                </th>
                                                <th>
                                                    Proveedor
                                                </th>
                                                <th>
                                                    Producto
                                                </th>
                                                <th>
                                                    precio
                                                </th>
                                                <th style="width:100px">
                                                    Imagen
                                                </th>
                                                <th style="width:160px">
                                                    Acciones
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($datatable as $items)
                                            <tr class="text-center">
                                                <td class="align-middle">
                                                    {{ $items->num }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $items->nombre }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $items->producto_nombre }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $items->precio }}
                                                </td>
                                                <td class="align-middle">
                                                    <img alt="imagen" class="img-thumbnail justify-content-center" src="{{ asset( $items->url) }}" style="height:100px;"/>
                                                </td>
                                                <td class="align-middle">
                                                    {{--<div class="row">
                                                        <a class="btn btn-primary btn-group-sm" href="{{ url('/producto/'.$items->id.'/edit') }}" title="Editar" type="button" data-placement="bottom">
                                                            <i class="fas fa-edit">
                                                            </i>
                                                        </a>
                                                        <div class="">
                                                            <form action="{{ url('/producto/'.$items->id) }}" class="formEliminar" method="POST">
                                                            @method('DELETE')
                                                                @csrf
                                                                <button class="btn btn-danger btn-group-sm" title="Eliminar" type="submit" data-placement="bottom">
                                                                    <i class="fa fa-trash">
                                                                    </i>
                                                                </button>
                                                            </form>
                                                        </div>  
                                                    </div>--}}
                                                    <div class="text-center">
                                                        <div class="row">
                                                            <div class="col-1" data-toggle="tooltip" data-placement="bottom" title="Ver Usuario">
                                                                <button type="button" onClick="modal({{ $items->id }})" data-toggle="modal" data-target="#modal-xl" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                                                            </div>
                                                        
                                                            <a href="{{ url('/usuario/'.encrypt($items->id).'/edit') }}" type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Editar Usuario"><i class="fas fa-edit"></i></a>
                                                        
                                                            <button type="button" class="btn btn btn-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </br>
                    </div>
                </div>
            </div>
        </div>
    </br>
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
