@extends('layout')

@section('sidebar')
	@include('workers.sidebar')  
@stop

@section('content')
	<div class="row">
		<h4>Importar trabajadores</h4>
	</div>

	<form method="POST" action="/worker/import" enctype="multipart/form-data">
		{{ csrf_field() }}

		<div class="form-group col-md-8 row {{ $errors->has('companie_id') ? ' has-error' : '' }}">
	        <label class="control-label">Empresa:</label>
	        <select id="companie_id" class="form-control input-sm" name="companie_id">
            	<option selected disabled>Seleccione la empresa</option>                    
            	@foreach($companies as $company)
            		<option value="{{ $company->id }}" @if (old('companie_id') == $company->id) selected @endif>{{ $company->name }}</option>
            	@endforeach                   
        	</select>              
        </div>

		<div class="form-group col-md-8 row {{ $errors->has('file') ? ' has-error' : '' }}">
			<label class="control-label">Archivo:</label>
			<input type="file" name="trabajadores" id="workers" class="form-group">	
		
			@if ($errors->has('file'))
	            <span class="help-block"><strong>{{ $errors->first('file') }}</strong></span>
          	@endif
	    </div>		
		
		<div class="form-group col-md-8 row" align="right">
          <button type="submit" class="btn btn-primary">Aceptar</button>
        </div>			
	</form>
@stop