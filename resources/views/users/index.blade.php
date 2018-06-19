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
					            <label class="control-label">Usuario:</label>
					            <div class="form-group">
					                <input type="text" class="form-control" name="username" id="username" value="">
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
						    <div class=" form-group checkbox">
			  				    <label class="control-label"><input type="checkbox" name="isGuard" id="isGuard">Vigilante</label>
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
	<h4 class="text-info" align="center">USUARIOS</h4>
	<div class="col-md-10">
        @if($errors->any())
	        <div class="alert alert-danger">
	            @foreach ($errors->all() as $error)
	            	<div>{{ $error }}</div>
	            @endforeach
	        </div>
        @endif
    </div>
    <div class="col-md-12">
    	<div class="table-responsive">
			<table class="table table-striped">
			    <thead>
			    	<tr>
				        <th>Nombre</th>
				        <th>Usuario</th>
				        <th>E-Mail</th>
				        <th>Teléfono</th>
				        <th class="text-center">Administrador</th>
				        <th class="text-center">Vigilante</th>
				        <th colspan="3" class="text-center">Operación</th>
			      	</tr>
			    </thead>
			    <tbody>
			    	@foreach($users as $user)
			      		<tr>
			        		<td>{{ $user->name }}</td>
			        		<td>{{ $user->username }}</td>
			        		<td>{{ $user->email }}</td>
			        		<td>{{ $user->telephone }}</td>	
			        		<td align="center"><input type="checkbox" disabled {{ ($user->isAdmin == 1) ? 'checked' : 'unchecked' }}></td>
			        		<td align="center"><input type="checkbox" disabled {{ ($user->isGuard == 1) ? 'checked' : 'unchecked' }}></td>
							<td align="right"><span data-toggle="tooltip" data-placement="top" title="Editar" data-container="body"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$user->id}}"><span class="glyphicon glyphicon-pencil"></span></button></span></td>
							<td align="center"><span data-toggle="tooltip" data-placement="top" title="Eliminar" data-container="body"><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$user->id}}"><span class="glyphicon glyphicon-trash"></span></button></span></td>
				        	<td align="left"><span data-toggle="tooltip" data-placement="top" title="Cambiar contraseña" data-container="body"><a href="/user/reset/{{$user->id}}" class="btn btn-info btn-xs" role="button"><span class="glyphicon glyphicon-lock"></span></a></span></td>
			     		</tr>
			     	@endforeach	     
			    </tbody>
			</table>
		</div>
	</div>	
@stop

@section('script')
	<script>
	    $('#myModalDelete').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); // Button that triggered the modal
		  	var user_id = button.data('id');

			modalDelete("user", user_id);
		});

		$('#myModalEdit').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
		  	var user_id = button.data('id')

		  	modalEdit("user",user_id);
		});
	</script>
@stop