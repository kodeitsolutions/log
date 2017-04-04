@extends('layout')

@section('sidebar')
	@include('categories.sidebar')  
@stop

@section('content')
    <div class="row">
      <div class="col-sm-10">
        <h4>Agregar un nueva Categoría</h4>
        <form method="POST" action="/category/add">
          {{ csrf_field()}}
          
          <div class="form-group col-xs-2 col-sm-8 {{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="control-label">Nombre:</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ingrese el nombre de la categoría." required>
            @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
          </div>

          <div class="form-group col-xs-2 col-sm-8 {{ $errors->has('description') ? ' has-error' : '' }}">
            <label class="control-label">Descripción:</label>
            <textarea class="form-control" rows="5" id="description" name="description" placeholder="Describa la información que requiere esta categoría." value="{{ old('description') }}" required></textarea>
            @if ($errors->has('description'))
              <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
              </span>
            @endif
          </div>

          <div class=" form-group checkbox col-xs-2 col-sm-8">
            <label class="control-label"><input type="checkbox" name="person">Persona</label>
          </div>

          <div class=" form-group checkbox col-xs-2 col-sm-8">
            <label class="control-label"><input type="checkbox" name="material">Material</label>
          </div>

          <div class=" form-group checkbox col-xs-2 col-sm-8">
            <label class="control-label"><input type="checkbox" name="vehicle">Vehículo</label>
          </div>

          <div class=" form-group checkbox col-xs-2 col-sm-8">
            <label class="control-label"><input type="checkbox" name="combined">Combinado</label>
          </div>

          <div class="form-group col-xs-2 col-sm-8" align="right">
            <button type="submit" class="btn btn-primary">Aceptar</button>
          </div>
        </form>
      </div>
    </div>
@stop