@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form  action="{{ url('/producto').'/'.$seleccion->id }}" method="POST" role="form" id="form" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Editar Producto</h3>
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="producto" value="{{ $seleccion }}">
                        <div class="row">
                            {{-- $productos->id --}}
                            <div class="form-group col-4">
                                <label for="nombre">Producto: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                <input type="text" class="form-control text-uppercase" name="nombre" value="{{ $seleccion->nombre}}">
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="precio">Precio: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                <input type="text" class="form-control" name="precio" value="{{ $seleccion->precio}}">
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="">Proveedor</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <select class="form-control text-uppercase" id="" name="proveedores_id" data-toggle="tooltip" data-placement="bottom" title="Seleccione el Proveedor">
                                        <option value="" disabled>Seleccione una opción</option>
                                        @foreach ($proveedor as $items)
                                            @if($items->id == $seleccion->id)
                                                <option selected="selected" value="{{ $items->id }}">{{ $items->nombre}}</option>
                                            @else
                                                <option value="{{ $items->id }}"> {{ $items->nombre }} </option>
                                            @endif 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="file" class="col-md-6 col-form-label text-md-right">Seleccione un archivo para cargar</label>
                                <div class="col-md-6">
                                    <input id="file" name="imagen" type="file" class="form-control-file @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}">
                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <img class="" id="imagenSeleccionada" style="max-height: 100px;">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Crear</button>
                            <a href="{{ url('/producto') }}" type="button" class="btn btn-danger"><i class="fa fa-eye"></i> Cancelar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (e){
        $('#file').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagenSeleccionada').attr('src',e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endsection