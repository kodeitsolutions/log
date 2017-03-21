@extends('layout')

@section('sidebar')
	@include('users.sidebar')	
@stop

@section('modal-delete')
	<div id="myModalDelete" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">Eliminar usuario</h4>
				</div>
				<div class="modal-body">
					<p>¿Está seguro que desea eliminar el usuario?</p>
					<label id="name">Nombre</label>
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
        			<h4 class="modal-title">Editar usuario</h4>
				</div>
				
				<form method="POST" action="" id="edit">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
						<div class="modal-body">
							<div class="form-group">
					            <label class="control-label">Nombre:</label>
					            <div class="form-group">
					                <input type="text" class="form-control" name="name" id="name" value="" autofocus>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label">E-Mail:</label>
					            <div class="form-group">
					                <input type="text" class="form-control" name="email" id="email" value="">
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label">Teléfono:</label>
					            <div class="form-group">
					                <input type="text" class="form-control" name="telephone" id="telephone" value="">
					            </div>
					        </div>
					        <div class=" form-group checkbox">
			  				    <label class="control-label"><input type="checkbox" name="isAdmin" id="isAdmin">Administrador</label>
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
		<table class="table table-striped" width="100%">
        <col style="width: 20%">
        <col style="width: 20%">
        <col style="width: 20%">
        <col style="width: 20%">
        <col style="width: 20%">
		    <thead>
		      <tr>
		        <th>Nombre</th>
		        <th>E-Mail</th>
		        <th>Teléfono</th>
		        <th style="text-align:center">Administrador</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($users as $user)
		      		<tr>
		        		<td>{{ $user->name }}</td>
		        		<td>{{ $user->email }}</td>
		        		<td>{{ $user->telephone }}</td>						
						@if ( $user->isAdmin == 1)
		        			<td style="text-align:center"><input type="checkbox" checked disabled></td>
						@else
							<td style="text-align:center"><input type="checkbox" unchecked disabled></td>
						@endif
						<td>
							<td align="right" data-toggle="tooltip" data-placement="top" title="Editar" data-container="body"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$user->id}}"><span class="glyphicon glyphicon-pencil"></span></button></td>
							<td align="right" data-toggle="tooltip" data-placement="top" title="Eliminar" data-container="body"><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$user->id}}"><span class="glyphicon glyphicon-trash"></span></button></td>
				        	<td align="right" data-toggle="tooltip" data-placement="top" title="Cambiar contraseña" data-container="body"><a href="/user/reset/{{$user->id}}" class="btn btn-info btn-xs" role="button"><span class="glyphicon glyphicon-lock"></span></a></td>
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
			  var user_id = button.data('id')

			  $.get('/user/getUser/' + user_id, function(response){
	  			$('label[id="name"]').text(response.name)  			
			  })
			  $('form[id="delete"]').attr('action','user/' + user_id)
			});

			$('#myModalEdit').on('show.bs.modal', function (event) {
			  var button = $(event.relatedTarget) // Button that triggered the modal
			  var user_id = button.data('id')

			  $.get('/user/getUser/' + user_id, function(response){
	  			$('input[id="name"]').val(response.name)
	  			$('input[id="email"]').val(response.email)
	  			$('input[id="telephone"]').val(response.telephone)
	  			console.log(response.isAdmin)
	  			if (response.isAdmin == 1) {
	  				console.log('Entra aquí true')
				    $('input[id="isAdmin"]').prop('checked', true)				    
				} else {
					console.log('Entra aquí false')
				    $('input[id="isAdmin"]').prop('checked', false)
				}
			  })
			  $('form[id="edit"]').attr('action','user/' + user_id)
			});
	    }); 

		
	</script>
@stop