@extends('layout')

@section('sidebar')
	@include('users.sidebar')	
@stop

@section('content')
    <div class="row">
      <div class="col-sm-10">
        <h4>Búsqueda de usuarios:</h4>
        <form method="GET" action="/user/searching">
          {{ csrf_field()}}
          	<div class="form-group col-xs-2 col-sm-8 {{ $errors->has('search') ? ' has-error' : '' }}">
            	<label>Buscar por:</label>
            	<select  id="search" class="form-control input-sm" name="search" required>
              		<option value="0" selected disabled>Seleccione el parámetro de búsqueda</option>
              		<option value="name">Nombre</option>
                  <option value="username">Usuario</option>
                  <option value="email">E-Mail</option>
            	</select>
            	@if ($errors->has('search'))
                    <span class="help-block">
                      <strong>{{ $errors->first('search') }}</strong>
                    </span>
                @endif                    
          	</div>

          	<div class="form-group col-xs-2 col-sm-8 {{ $errors->has('value') ? ' has-error' : '' }}">
              	<input type="text" class="form-control" name="value" value="{{ old('value') }}" placeholder="Buscar...">
              	@if ($errors->has('value'))
                  	<span class="help-block">
                      	<strong>{{ $errors->first('value') }}</strong>
                  	</span>
              	@endif             
          	</div>

          <div class="form-group col-xs-2 col-sm-8" align="right">
            <button type="submit" class="btn btn-primary">Buscar</button>
          </div>
        </form>
      </div>
    </div>
@stop