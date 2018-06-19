@extends('layout')

@section('sidebar')
	@include('operations.sidebar')  
@stop

@section('content')  
  <div class="row">
    <h4>Agregar un nuevo Tipo de Movimiento</h4>
  </div>
  <form method="POST" action="/operation/add">
    {{ csrf_field()}}
    
    <div class="form-group col-md-8 row {{ $errors->has('name') ? ' has-error' : '' }}">      
      <label class="control-label">Nombre:</label>      
      <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ingrese el nombre del movimiento." required>
        
      @if ($errors->has('name'))
        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
      @endif
    </div>

    <div class="form-group row col-md-8" align="right"> 
      <button type="submit" class="btn btn-primary"  >Aceptar</button>
    </div>
  </form>
@stop