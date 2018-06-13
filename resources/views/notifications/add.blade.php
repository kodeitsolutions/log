@extends('layout')

@section('sidebar')
	@include('notifications.sidebar')  
@stop

@section('content')
	<div class="row">
      	<div class="col-sm-10">
        	<h4>Crear una nueva notificación</h4>
        	<form method="POST" action="/notification/add">
        	{{ csrf_field()}}

        	<div class="form-group col-xs-2 col-sm-8">
        		<label class="control-label {{ $errors->has('recipient') ? ' has-error' : '' }}">E-mail de Destinatario(s):</label>
                <input type="text" class="form-control" name="recipient" value="{{ old('recipient') }}" placeholder="Ingrese el correo del destinatario (Si hay mas de uno separarlos con coma)." autofocus>
        	</div>

        	<div class="form-group col-xs-2 col-sm-8 form-check form-check-inline" >
        		<label class="control-label {{ $errors->has('moment') ? ' has-error' : '' }}">Momento:</label><br>        					  	
				<input class="form-check-input" type="checkbox" name="moment[]" value="store" @if(is_array(old('moment')) && in_array('store', old('moment'))) checked @endif> Guardar registro				  	
			  	<input class="form-check-input" type="checkbox" name="moment[]" value="cron" data-toggle="tooltip" data-placement="top" title="6:00 PM" data-container="body" @if(is_array(old('moment')) && in_array('cron', old('moment'))) checked @endif> Final del día
			</div>

        	<div class="form-group col-xs-2 col-sm-8 form-check form-check-inline">
        		<label class="control-label {{ $errors->has('operation') ? ' has-error' : '' }}">Tipos de Movimientos:</label><br>
        		@foreach($operations as $operation)				  	
				    <input class="form-check-input" type="checkbox" name="operation[]" id="operation" value="{{ $operation->id}}" @if(is_array(old('operation')) && in_array($operation->id, old('operation'))) checked @endif> {{ $operation->name }}				  	
			  	@endforeach
			  	<button type="button" class="btn btn-default btn-xs" id="operation_all">Todos</button>
			</div>

			<div class="form-group col-xs-2 col-sm-8 form-check form-check-inline">
        		<label class="control-label {{ $errors->has('category') ? ' has-error' : '' }}">Categorías:</label><br>
        		@foreach($categories as $category)				  	
				    <input class="form-check-input" type="checkbox" name="category[]" id="category" value="{{ $category->id}}" @if(is_array(old('category')) && in_array($category->id, old('category'))) checked @endif> {{ $category->name }}				  	
			  	@endforeach
			  	<button type="button" class="btn btn-default btn-xs" id="category_all">Todos</button>
			</div>

			<div class="form-group col-xs-2 col-sm-8 form-check form-check-inline">
        		<label class="control-label {{ $errors->has('company') ? ' has-error' : '' }}">Empresas:</label><br>
        		@foreach($companies as $company)				  	
				    <input class="form-check-input" type="checkbox" name="company[]" id="company" value="{{ $company->id}}" @if(is_array(old('company')) && in_array($company->id, old('company'))) checked @endif> {{ $company->name }}				  	
			  	@endforeach
			  	<button type="button" class="btn btn-default btn-xs" id="company_all">Todos</button>
			</div>

			<div class="form-group col-xs-2 col-sm-8 form-check form-check-inline">
        		<label class="control-label">Materiales:</label><br>
        		@foreach($materials as $material)				  	
				    <input class="form-check-input" type="checkbox" name="material[]" id="material" value="{{ $material->id}}" @if(is_array(old('material')) && in_array($material->id, old('material'))) checked @endif disabled> {{ $material->name }}				  	
			  	@endforeach
			  	<button type="button" class="btn btn-default btn-xs" id="material_all">Todos</button>
			</div>

			<div class="col-md-10">
			    @if($errors->any())
			        <div class="alert alert-danger">
			          	<strong>Campos requeridos</strong>
			        </div>
			    @endif
		    </div>

			<div class="form-group col-xs-2 col-sm-8" align="right">
            	<button type="submit" class="btn btn-primary">Aceptar</button>
          	</div>

        	</form>        	
        </div>
    </div>
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
		    notifications();
		})
	</script>
@stop