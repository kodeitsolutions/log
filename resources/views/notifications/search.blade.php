@extends('layout')

@section('sidebar')
	@include('notifications.sidebar')	
@stop

@section('content')
    <div class="row">
      <div class="col-sm-10">
        <h4>Búsqueda de notificaciones:</h4>
        <form method="GET" action="/notification/searching">
          {{ csrf_field()}}
          	{{--<div class="form-group col-xs-2 col-sm-8 {{ $errors->has('search') ? ' has-error' : '' }}">
            	<label>Buscar por:</label>
            	<select  id="search" class="form-control input-sm" name="search" required>
            		<option value="0" selected disabled>Seleccione el parámetro de búsqueda</option>
            		<option value="moment">Momento</option>
                <option value="operation">Tipo de Movimiento</option>
                <option value="category">Categoría</option>
                <option value="company">Empresa</option>
                <option value="material">Material</option>
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
        	</div>--}}

          <div class="form-group col-md-9">
            <label class="control-label col-md-3">Momento:</label>
            <div class="col-md-6">
              <select  id="moment" class="form-control input-sm" name="moment" required>
                <option value="0" selected disabled>Seleccione el momento de envío</option>
                <option value="store">Guardar registro</option>
                <option value="cron">Final del día</option>
              </select>
            </div>
          </div>

          <div class="form-group col-md-9">
            <label class="control-label col-md-3">Creada por:</label>
            <div class="col-md-6">
              <select  id="user" class="form-control input-sm" name="user_id">
                <option selected disabled>Seleccione el usuario</option>
                @foreach($users as $user)
                   <option value="{{ $user->id }}" @if (old('user_id') == $user->id) selected @endif>{{ $user->name }}</option>
                @endforeach
              </select>         
            </div>
          </div>

          <div class="form-group col-md-9">
            <label class="control-label col-md-3">Tipo de Movimiento:</label>
            <div class="col-md-6">
              <select  id="operation" class="form-control input-sm" name="operation">
                <option selected disabled>Seleccione el tipo de movimiento</option>
                @foreach($operations as $operation)
                  <option value="{{ $operation->id }}" @if (old('operation_id') == $operation->id) selected @endif>{{ $operation->name }}</option>
                @endforeach
              </select>         
            </div>
          </div>

          <div class="form-group col-md-9">
            <label class="control-label col-md-3">Categoría:</label>
            <div class="col-md-6">
                <select id="category" class="form-control input-sm" name="category" >
                  <option selected disabled>Seleccione la categoría</option>                    
                  @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if (old('category') == $category->id) selected @endif>{{ $category->name }}</option>
                  @endforeach                  
                </select>  
            </div>
          </div>

          <div class="form-group col-md-9">
            <label class="control-label col-md-3">Empresa:</label>
            <div class="col-md-6">
              <select id="company" class="form-control input-sm" name="company">
                <option selected disabled>Seleccione la empresa</option>
                @foreach($companies as $company)
                  <option value="{{ $company->id }}" @if (old('company') == $company->id) selected @endif>{{ $company->name }}</option>
                @endforeach                     
              </select>  
            </div>
          </div>

          <div class="form-group col-md-9">
            <label class="control-label col-md-3">Tipo de Material:</label>
            <div class="col-md-6">
                <select id="material" class="form-control input-sm" name="material" >
                  <option selected disabled>Seleccione el tipo de material</option>                    
                  @foreach($materials as $material)
                    <option value="{{ $material->id }}" @if (old('material') == $material->id) selected @endif>{{ $material->name }}</option>
                  @endforeach                  
                </select>  
            </div>
          </div>

          <div class="form-group col-xs-2 col-sm-8" align="right">
            <button type="submit" class="btn btn-primary">Buscar</button>
          </div>
        </form>
      </div>
    </div>
@stop