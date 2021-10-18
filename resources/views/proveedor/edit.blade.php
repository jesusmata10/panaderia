@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="row">
	    <div class="col-12">
	        <form action="{{ url('/proveedor').'/'.$proveedores->id }}" method="POST" role="form" id="form">
	            @method('PUT')
	            @csrf

	            <div class="card card-primary">
	                <div class="card-header">
	                    <h3 class="card-title text-bold">Editar Proveedor</h3>
	                </div>
	                <div class="card-body">
	                	<input type="hidden" class="form-control" name="id" value="{{ $proveedores->id }}">
	                    <div class="row">
	                        <div class="form-group col-4">
	                            <label for="nombre">Nombre: </label>
	                            <div class="input-group">
	                                <div class="input-group-prepend">
	                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
	                                </div>
	                            <input type="text" class="form-control" name="nombre" value="{{ $proveedores->nombre }}">
	                            </div>
	                        </div>
	                        <div class="form-group col-4">
	                            <label for="correo">Correo: </label>
	                            <div class="input-group">
	                                <div class="input-group-prepend">
	                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
	                                </div>
	                            <input type="text" class="form-control" name="correo" value="{{ $proveedores->correo }}">
	                            </div>
	                        </div>
	                        <div class="form-group col-4">
	                            <label for="edad">Edad: </label>
	                            <div class="input-group">
	                                <div class="input-group-prepend">
	                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
	                                </div>
	                            <input type="text" class="form-control" name="edad" value="{{ $proveedores->edad }}">
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="card-footer">
	                    <div class="float-right">
	                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Guardar</button>
	                        <a href="{{ url('/proveedor') }}" type="button" class="btn btn-primary"><i class="fa fa-eye"></i> Cancelar</a>
	                    </div>
	                </div>
	            </div>
	        </form>
	    </div>
	</div>
</div>
@endsection