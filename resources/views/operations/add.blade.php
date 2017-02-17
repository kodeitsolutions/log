@extends('layout')

@section('sidebar')
	@include('operations.sidebar')  
@stop

@section('content')
    <div class="row">
      <div class="col-sm-10">
        <h4>Agregar un nuevo Tipo de Movimiento</h4>
        <form method="POST" action="/operation/add">
          {{ csrf_field()}}
          
          <div class="form-group col-xs-2 col-sm-8 {{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="control-label">Nombre:</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ingrese el nombre del movimiento." required>
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