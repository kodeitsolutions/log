@extends('layout')

@section('sidebar')
	@include('workers.sidebar')  
@stop

@section('content')
	<div class="row">
		<div class="col-sm-10">
			<h4>Importar trabajadores</h4>
			<form method="POST" action="/worker/import" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="form-group col-xs-2 col-sm-8 {{ $errors->has('companie_id') ? ' has-error' : '' }}">
			        <label class="control-label">Empresa:</label>
			        <select id="companie_id" class="form-control input-sm" name="companie_id">
		            	<option selected disabled>Seleccione la empresa</option>                    
		            	@foreach($companies as $company)
		            		<option value="{{ $company->id }}" @if (old('companie_id') == $company->id) selected @endif>{{ $company->name }}</option>
		            	@endforeach                   
		        	</select>              
		        </div>

				<div class="form-group col-xs-2 col-sm-8 {{ $errors->has('file') ? ' has-error' : '' }}">
					<label class="control-label">Archivo:</label>
					<input type="file" name="trabajadores" id="workers" class="form-group">	
				
					@if ($errors->has('file'))
			            <span class="help-block">
			                <strong>{{ $errors->first('file') }}</strong>
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