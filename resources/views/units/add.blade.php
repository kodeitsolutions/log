@extends('layout')

@section('sidebar')
	@include('units.sidebar')  
@stop

@section('content')
    <div class="row">
      <div class="col-sm-10">
        <h4>Agregar un nueva Unidad</h4>
        <form method="POST" action="/unit/add">
          {{ csrf_field()}}
          
          <div class="form-group col-xs-2 col-sm-8 {{ $errors->has('code') ? ' has-error' : '' }}">
            <label class="control-label">Código:</label>
            <input type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="Ingrese el código de la unidad." required>
            @if ($errors->has('code'))
              <span class="help-block">
                <strong>{{ $errors->first('code') }}</strong>
              </span>
            @endif
          </div>

          <div class="form-group col-xs-2 col-sm-8 {{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="control-label">Nombre:</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ingrese el nombre de la unidad." required>
            @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
          </div>

          <div class="form-group col-xs-2 col-sm-8" align="right">
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
        </form>
      </div>
    </div>
@stop