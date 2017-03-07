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
					                <textarea name="name" id="name" class="form-control" autofocus></textarea>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label">E-Mail:</label>
					            <div class="form-group">
					                <textarea name="email" id="email" class="form-control"></textarea>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label">Teléfono:</label>
					            <div class="form-group">
					                <textarea name="telephone" id="telephone" class="form-control"></textarea>
					            </div>
					        </div>
					        <div class=" form-group checkbox">
			  				    <label class="control-label"><input type="checkbox" name="isAdmin">Administrador</label>
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
		<table class="table table-striped">
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
						<td align="right"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$user->id}}"><span class="glyphicon glyphicon-pencil"></span></button>
			        	<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$user->id}}"><span class="glyphicon glyphicon-trash"></span></button>
			        	<a href="/user/reset/{{$user->id}}" class="btn btn-info btn-xs" role="button"><span class="glyphicon glyphicon-lock"></a>
			        	</td>
		     		</tr>
		     	@endforeach	     
		    </tbody>
		 </table>
	</div>
@stop

@section('script')
	<script type="text/javascript">
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
  			$('textarea[id="name"]').text(response.name)
  			$('textarea[id="email"]').text(response.email)
  			$('textarea[id="telephone"]').text(response.telephone)
  			if (response.isAdmin) {
			    $('input[name="isAdmin"]').prop('checked', true);
			} else {
			    $('input[name="isAdmin"]').prop('checked', false);
			}
		  })
		  $('form[id="edit"]').attr('action','user/' + user_id)
		});
	</script>
@stop