@extends('layout')

@section('sidebar')
	@include('materials.sidebar')  
@stop

@section('content')
  <div class="row">
    <h4>Agregar un nuevo Tipo de Material</h4>
  </div>

  <form method="POST" action="/material/add">
    {{ csrf_field()}}
    
    <div class="form-group col-md-8 row {{ $errors->has('code') ? ' has-error' : '' }}">
      <label class="control-label">Código:</label>
      <input type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="Ingrese el código del tipo de material." required>
      @if ($errors->has('code'))
        <span class="help-block"><strong>{{ $errors->first('code') }}</strong></span>
      @endif
    </div>

    <div class="form-group col-md-8 row {{ $errors->has('name') ? ' has-error' : '' }}">
      <label class="control-label">Nombre:</label>
      <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ingrese el nombre del tipo de material." required>
      @if ($errors->has('name'))
        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
      @endif
    </div>

    <div class="form-group col-md-8 row" align="right">
      <button type="submit" class="btn btn-primary">Aceptar</button>
    </div>
  </form>
@stop