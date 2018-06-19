@extends('layout')

@section('sidebar')
	@include('workers.sidebar')  
@stop

@section('content')
  <div class="row">
    <h4>Agregar un nuevo Trabajador</h4>
  </div>
  <form method="POST" action="/worker/add">
    {{ csrf_field()}}
    
    <div class="form-group col-md-8 row {{ $errors->has('name') ? ' has-error' : '' }}">
      <label class="control-label">Nombre:</label>
      <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ingrese el nombre." required autofocus>

      @if ($errors->has('name'))
        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
      @endif
    </div>

    <div class="form-group col-md-8 row {{ $errors->has('worker_id') ? ' has-error' : '' }}">
      <label class="control-label">Cédula:</label>
      <input type="text" class="form-control" name="worker_id" value="{{ old('worker_id') }}" placeholder="Ingrese la cédula." required>

      @if ($errors->has('worker_id'))
        <span class="help-block"><strong>{{ $errors->first('worker_id') }}</strong></span>
      @endif
    </div>

    <div class="form-group col-md-8 row {{ $errors->has('companie_id') ? ' has-error' : '' }}">
      <label class="control-label">Empresa:</label>
      <select id="companie_id" class="form-control input-sm" name="companie_id">
        <option selected disabled>Seleccione la empresa</option>                    
        @foreach($companies as $company)
          <option value="{{ $company->id }}" @if (old('companie_id') == $company->id) selected @endif>{{ $company->name }}</option>
        @endforeach                   
      </select>              
    </div>

    <div class="form-group col-md-8 row {{ $errors->has('department') ? ' has-error' : '' }}">
      <label class="control-label">Departamento:</label>
      <input type="text" class="form-control" name="department" value="{{ old('department') }}" placeholder="Ingrese el departamento al que pertenece." required>

      @if ($errors->has('department'))
        <span class="help-block"><strong>{{ $errors->first('department') }}</strong></span>
      @endif
    </div>

    <div class="form-group col-md-8 row {{ $errors->has('position') ? ' has-error' : '' }}">
      <label class="control-label">Cargo:</label>
      <input type="text" class="form-control" name="position" value="{{ old('position') }}" placeholder="Ingrese el cargo que ocupa." required>

      @if ($errors->has('position'))
        <span class="help-block"><strong>{{ $errors->first('position') }}</strong></span>
      @endif
    </div>        

    <div class="form-group col-md-8 row" align="right">
      <button type="submit" class="btn btn-primary">Aceptar</button>
    </div>
  </form>
@stop