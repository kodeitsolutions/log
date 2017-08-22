@extends('layout')

@section('sidebar')
	@include('notifications.sidebar')  
@stop

@section('modal-delete')
  <div id="myModalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Eliminar notificación</h4>
        </div>
        <div class="modal-body">
          <p>¿Está seguro que desea eliminar la notificación?</p>          
        </div>
        <div class="modal-footer ">           
          <form method="POST" action="" id="delete">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger btn-delete">Eliminar</button>
          </form>
        </div>
      </div>      
    </div>    
  </div>
@stop

@section('modal-edit')
	<div id="myModalEdit" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">Editar notificación</h4>
				</div>
				
				<form method="POST" action="" id="edit">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label">Estatus:</label>
								<select class="form-control input-sm" id="status" name="status">
									<option value="A">ACTIVO</option>
									<option value="I">INACTIVO</option>
								</select>
							</div>
							<div class="form-group">
					            <label class="control-label">Destinatario:</label>
					            <div class="form-group">
					                <input type="text" class="form-control" name="recipient" id="recipient" value="" autofocus>
					            </div>
					        </div>
					        <div class="form-group form-check form-check-inline" >
				        		<label class="control-label {{ $errors->has('moment') ? ' has-error' : '' }}">Momento:</label><br>        					  	
								<input class="form-check-input" type="checkbox" name="moment[]" id="store" value="store"> Guardar registro				  	
							  	<input class="form-check-input" type="checkbox" name="moment[]" id="cron" value="cron"> Final del día
							</div>
					        <div class="form-group form-check form-check-inline">
				        		<label class="control-label">Tipos de Movimientos:</label><br>
			        			@foreach($operations as $operation)					        		
				        			<input class="form-check-input" type="checkbox" name="operation[]" id="operation/{{ $operation->id }}" value="{{ $operation->id }}"> {{ $operation->name }}
				        		@endforeach
							</div>

							<div class="form-group form-check form-check-inline">
				        		<label class="control-label">Categorías:</label><br>
				        		@foreach($categories as $category)				  	
								    <input class="form-check-input" type="checkbox" name="category[]" id="category/{{ $category->id }}" value="{{ $category->id }}"> {{ $category->name }}			  	
							  	@endforeach
							</div>

							<div class="form-group form-check form-check-inline">
				        		<label class="control-label">Empresas:</label><br>
				        		@foreach($companies as $company)				  	
								    <input class="form-check-input" type="checkbox" name="company[]" id="company/{{ $company->id }}" value="{{ $company->id }}"> {{ $company->name }}			  	
							  	@endforeach
							</div>

							<div class="form-group form-check form-check-inline">
				        		<label class="control-label">Materiales:</label><br>
				        		@foreach($materials as $material)				  	
								    <input class="form-check-input" type="checkbox" name="material[]" id="material/{{ $material->id }}" value="{{ $material->id }}"> {{ $material->name }}			  	
							  	@endforeach
							</div>
				        </div>
				        <div class="modal-footer form-group">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-primary btn-edit">Guardar</button>
						</div>
			    </form> 		
			</div>			
		</div>		
	</div>
@stop

@section('content')
	<div class="col-md-11">
	    <h4 class="text-info" align="center">NOTIFICACIONES</h4>
	    <table class="table table-striped" width="100%">
	        <col style="width: 15%">
	        <col style="width: 15%">
	        <col style="width: 70%">	        
	        <thead>
	            <tr>
	              <th>Creado por</th>
	              <th>Estatus</th>
	              <th>Condiciones</th>
	            </tr>
	        </thead>
	        <tbody>
	          	@foreach($notifications as $notification)
	          		<?php $conditions = json_decode($notification->conditions, true); ?>
	              	<tr>
		                <td>{{ $notification->user->name }}</span></td>
		                <td>{{ ($notification->status == 'A') ? 'ACTIVO' : 'INACTIVO' }}</td>
		                <td>
			                Destinatario: {{ $conditions['recipient'] }}.<br>
			                Momento:
			                @foreach($conditions['moment'] as $moment)
			                	{{ ($moment == 'cron') ? ' Final del día.' : ' Guardar registro.' }}
			                @endforeach
			                <br>
			                Tipo de Movimiento:
			                @foreach($conditions['operation'] as $operation)
			                	 {{ $notification->operation($operation) }}.
			               	@endforeach
			               	<br>
			               	@if(isset($conditions['category']))
			               		Categoría:
				               	@foreach($conditions['category'] as $category)
				                	 {{ $notification->category($category) }}.
				               	@endforeach
				            @endif
			               	<br>
			               	@if(isset($conditions['company']))
			               		Empresa:
				               	@foreach($conditions['company'] as $company)
				                	 {{ $notification->company($company) }}.
				               	@endforeach
				            @endif
			               	<br>
			               	@if(isset($conditions['material']))
			               		Material:
				               	@foreach($conditions['material'] as $material)
				                	 {{ $notification->material($material) }}.
				               	@endforeach
				            @endif
		                </td>
		                <td>
			                <td align="right" data-toggle="tooltip" data-placement="top" title="Editar" data-container="body"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$notification->id}}"><span class="glyphicon glyphicon-pencil"></span></button></td>
			                <td align="right" data-toggle="tooltip" data-placement="top" title="Eliminar" data-container="body"><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$notification->id}}"><span class="glyphicon glyphicon-trash"></span></button></td>
		                </td>   
	            	</tr>
	          	@endforeach      
	        </tbody>
	    </table>
	</div>   
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
	        $('[data-toggle="tooltip"]').tooltip(); 

	        $('#myModalDelete').on('show.bs.modal', function (event) {
		        var button = $(event.relatedTarget) // Button that triggered the modal
		        var notification_id = button.data('id')

		        /*$.get('/unit/getUnit/' + notification_id, function(response){
		        $('label[id="name"]').text(response.name)
		        })*/
		        $('form[id="delete"]').attr('action','notification/' + notification_id)
		    });

		    $('#myModalEdit').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
			  	var notification_id = button.data('id')
			  	$(".form-check-input").prop('checked', false)

			  	$.get('/notification/getNotification/' + notification_id, function(response){
			  		var conditions = jQuery.parseJSON(response.conditions)
			  		$('input[id="recipient"]').val(conditions.recipient)
	  				$.each(conditions.moment, function(key, value) {
					    $('input[id="'+ value +'"]').prop('checked',true)
					})
					$.each(conditions.operation, function(key, value) {
					    $('input[id="operation/'+ value +'"]').prop('checked', true)
					})
					$.each(conditions.category, function(key, value) {
					    $('input[id="category/'+ value +'"]').prop('checked',true)
					})
		  			$.each(conditions.company, function(key, value) {
					    $('input[id="company/'+ value +'"]').prop('checked',true)
					})
					$.each(conditions.material, function(key, value) {
					    $('input[id="material/'+ value +'"]').prop('checked',true)
					})
					$("#status").val(response.status)
				  })
				$('form[id="edit"]').attr('action','notification/' + notification_id)

			});
	    });     
	</script>
@stop