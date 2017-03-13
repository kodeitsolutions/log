@extends('layout')

@section('sidebar')
	@include('users.sidebar')
@stop

@section('content')
    <div class="row">
      <div class="col-sm-10">
        <h4>Agregar un nuevo Usuario</h4>
        <form method="POST" action="/user/add">
        	{{ csrf_field()}}
            <div class="form-group col-xs-2 col-sm-8 {{ $errors->has('name') ? ' has-error' : '' }}">
                <label class="control-label">Nombre:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ingrese el nombre." required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-xs-2 col-sm-8 {{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="control-label">Contraseña:</label>
                <input type="password" class="form-control" name="password" placeholder="Ingrese la contraseña." required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

          	<div class="form-group col-xs-2 col-sm-8 {{ $errors->has('email') ? ' has-error' : '' }}">
            	<label class="control-label">E-Mail:</label>
              	<input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Ingrese el E-Mail." required>

              	@if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
          	</div>

          	<div class="form-group col-xs-2 col-sm-8 {{ $errors->has('telephone') ? ' has-error' : '' }}">
            	<label class="control-label">Teléfono:</label>
              	<input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" placeholder="Ingrese el teléfono sin guión ni espacio.">

              	@if ($errors->has('telephone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('telephone') }}</strong>
                    </span>
                @endif
          	</div>

          	<div class=" form-group checkbox col-xs-2 col-sm-8">
  				    <label class="control-label"><input type="checkbox" name="isAdmin">Administrador</label>
			      </div>

          	<div class="form-group col-xs-2 col-sm-8" align="right">
            	<button type="submit" class="btn btn-primary">Aceptar</button>
          	</div>
        </form>
      </div>
    </div>
@stop