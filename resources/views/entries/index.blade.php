@extends('layout')

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
					            <label class="control-label">Fecha:</label>
					            <input type="date" name="created_at" id="created_at" class="form-control">
					        </div>
							<div class="form-group">
					            <label class="control-label">Usuario:</label>
					            <input type="text" name="user" id="user" class="form-control">
					        </div>
					        <div class="form-group">
					            <label class="control-label">Movimiento:</label>
					            <input type="text" name="operation" id="operation" class="form-control">
					        </div>
					        <div class="form-group">
					            <label class="control-label">Categoría:</label>
					            <input type="text" name="type" id="type" class="form-control">
					        </div>
					        <div class="form-group">
					            <label class="control-label">Empresa:</label>
					            <input type="text" name="company" id="company" class="form-control">
					        </div>
					        <div class="form-group">
					            <label class="control-label">Destino:</label>
					            <input type="text" name="destination" id="destination" class="form-control">
					        </div>
					        <div class="form-group">
					            <label class="control-label">Hora:</label>
					            <div class="form-group">
					                <textarea name="" id="" class="form-control"></textarea>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label">:</label>
					            <div class="form-group">
					                <textarea name="" id="" class="form-control"></textarea>
					            </div>
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

@section('form')
	<div class="col-md-11">
		<h3 class="text-info" align="center">LOG DE REGISTROS AL {{ $date }} </h3>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Usuario</th>
					<th>Movimiento</th>
					<th>Categoría</th>
					<th>Empresa</th>
					<th>Destino</th>
					<th>Hora</th>
					<th>Nombre</th>
					<th>Cédula</th>
					<th>Ocupación</th>
					<th>Material</th>
					<th>Cantidad</th>
					<th>Unidad</th>
					<th>Vehículo</th>
					<th>Placa</th>
				</tr>
			</thead>
			<tbody>
				@foreach($entries as $entrie)
					<tr>
						<td>{{ $entrie->created_at->format('d/m/Y H:i') }}</td>
						<td>{{ $entrie->user->name }}</td>
						<td>{{ $entrie->operation }}</td>
						<td>{{ $entrie->type }}</td>
						<td>{{ $entrie->company}}</td>
						<td>{{ $entrie->destination }}</td>
						<td>{{ $entrie->time }}</td>
						@if( $entrie->type == 'Persona')
							<td>{{ $entrie->person_name }}</td>
							<td>{{ $entrie->person_id }}</td>
							<td>{{ $entrie->person_occupation }}</td>
						@else
							<td>N/A</td>
							<td>N/A</td>
							<td>N/A</td>
						@endif
						@if( $entrie->type == 'Material')
							<td>{{ $entrie->material_type }}</td>
							<td>{{ $entrie->material_quantity }}</td>
							<td>{{ $entrie->material_unit}}</td>
						@else
							<td>N/A</td>
							<td>N/A</td>
							<td>N/A</td>
						@endif
						<td>{{ $entrie->vehicle }}</td>
						<td>{{ $entrie->vehicle_plate }}</td>
						<td align="right"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$entrie->id}}"><span class="glyphicon glyphicon-pencil"></span></button></td>
               			<td align="right"><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$entrie->id}}"><span class="glyphicon glyphicon-trash"></span></button>
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
		  var entry_id = button.data('id')

		  $.get('/entry/getEntry/' + entry_id, function(response){
  			$('label[id="name"]').text(response.name)  			
		  })
		  $('form[id="delete"]').attr('action','entry/' + entry_id)
		});

		$('#myModalEdit').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var entry_id = button.data('id')

		  $.get('/entry/getEntry/' + entry_id, function(response){
		  	console.log(response)
		  	/*var date = response.created_at.format('YYYY-MM-DD')
  			$('input[id="created_at"]').val(date)*/
  			$('input[id="operation"]').val(response.operation)
  			$('input[id="type"]').val(response.type)
  			$('input[id="company"]').val(response.company)
  			$('input[id="destination"]').val(response.destination)
  			/*if (response.isAdmin) {
			    $('input[name="isAdmin"]').prop('checked', true);
			} else {
			    $('input[name="isAdmin"]').prop('checked', false);
			}*/
		  })
		  $('form[id="edit"]').attr('action','entry/' + entry_id)
		});
	</script>
@stop