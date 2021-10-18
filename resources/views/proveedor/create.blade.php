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
	        @if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
	        <form  action="{{ url('/proveedor') }}" method="POST" role="form" id="form">
	            {{ csrf_field() }}
	            <div class="card card-primary">
	                <div class="card-header">
	                    <h3 class="card-title text-bold">Crear Nuevo Proveedor</h3>
	                </div>
	                <div class="card-body">
	                    <div class="row">
	                        <div class="form-group col-4">
	                            <label for="nombre">Nombre: </label>
	                            <div class="input-group">
	                                <div class="input-group-prepend">
	                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
	                                </div>
	                            <input type="text" class="form-control" name="nombre">
	                            </div>
	                        </div>
	                        <div class="form-group col-4">
	                            <label for="correo">Correo: </label>
	                            <div class="input-group">
	                                <div class="input-group-prepend">
	                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
	                                </div>
	                            <input type="text" class="form-control" name="correo">
	                            </div>
	                        </div>
	                        <div class="form-group col-4">
	                            <label for="edad">Edad: </label>
	                            <div class="input-group">
	                                <div class="input-group-prepend">
	                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
	                                </div>
	                            <input type="text" class="form-control" name="edad">
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="card-footer">
	                    <div class="float-right">
	                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Crear</button>
	                        <a href="{{ url('/proveedor') }}" type="button" class="btn btn-danger"><i class="fa fa-eye"></i> Cancelar</a>
	                    </div>
	                </div>
	            </div>
	        </form>
	    </div>
	</div>
</div>
@endsection