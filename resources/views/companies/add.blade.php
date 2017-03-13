@extends('layout')

@section('sidebar')
	@include('companies.sidebar')  
@stop

@section('content')
    <div class="row">
      <div class="col-sm-10">
        <h4>Agregar una nueva Empresa</h4>
        <form method="POST" action="/company/add">
          {{ csrf_field()}}
          
          <div class="form-group col-xs-2 col-sm-8 {{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="control-label">Nombre:</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ingrese el nombre de la empresa." required>
              @if ($errors->has('name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
          </div>

          <div class="form-group col-xs-2 col-sm-8" align="right">
            <button type="submit" class="btn btn-primary">Aceptar</button>
          </div>
        </form>
      </div>
    </div>
@stop