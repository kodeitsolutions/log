@extends('layout')

@section('sidebar')
	@include('shifts.sidebar')  
@stop

@section('content')
  <div class="row">
    <h4>Agregar un nuevo Turno</h4>
  </div>

  <form method="POST" action="/shift/add">
    {{ csrf_field()}}
    
    <div class="form-group col-md-8 row {{ $errors->has('description') ? ' has-error' : '' }}">
      <label class="control-label">Descripción:</label>            
      <input type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Ingrese el nombre del turno." required>
      @if ($errors->has('description'))
        <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
      @endif
    </div>

    <div class="form-group col-md-8 row">
      <label class="control-label ">Hora Comienzo:</label>
      <br>
      <div class="col-md-6">
        <input type="text" name="start"  value="{{ old('start') }}" class="form-control time_element"/>
      </div>
    </div>

    <div class="form-group col-md-8 row">
      <label class="control-label">Hora Fin:</label>
      <br>
      <div class="col-md-6">            
        <input type="text" name="end" value="{{ old('end') }}" class="form-control time_element"/>
      </div>
    </div>

    <div class="form-group col-md-8 row" align="right">
      <button type="submit" class="btn btn-primary">Aceptar</button>
    </div>
  </form>
@stop