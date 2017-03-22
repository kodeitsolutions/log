@extends('layout')

@section('modal-delete')
	<div id="myModalDelete" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">Eliminar registro</h4>
				</div>
				<div class="modal-body">
					<p>¿Está seguro que desea eliminar este registro?</p>					
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

@section('table')
	<div class="col-md-12">
		@if($date != '')
			<h3 class="text-info" align="center">LOG DE REGISTROS AL {{ $date }} </h3>
		@endif
		<table class="table table-striped" style="font-size: 12px;">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Hora</th>
					<th>Usuario</th>
					<th>Movimiento</th>
					<th>Categoría</th>
					<th>Empresa</th>
					<th>Destino / Origen</th>
					<th>Nombre</th>
					<th>Cédula</th>
					<th>Ocupación</th>
					<th>Empresa</th>
					<th>Material</th>
					<th>Cantidad</th>					
					<th>Unidad</th>					
					<th>Vehículo</th>
					<th>Chofer</th>
					<th>Observaciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($entries as $entrie)
					<tr>
						<td>{{ $entrie->date->format('d/m/Y')}}</td>
						<td>{{ $entrie->time }}</td>
						<td>{{ $entrie->user->name }}</td>
						<td>{{ $entrie->operation->name }}</td>
						<td>{{ $entrie->category->name }}</td>
						<td>{{ $entrie->company->name }}</td>
						<td>{{ $entrie->destination }}</td>						
						@if( $entrie->category->name == 'Persona' or $entrie->category->name == 'Persona-Material')
							<td>{{ $entrie->person_name }}</td>
							<td>{{ $entrie->person_id }}</td>
							<td>{{ $entrie->person_occupation }}</td>
							<td>{{ $entrie->person_company }}</td>
						@else
							<td>N/A</td>
							<td>N/A</td>
							<td>N/A</td>
							<td>N/A</td>
						@endif
						@if( $entrie->category->name == 'Material' or $entrie->category->name == 'Persona-Material')
							<td>{{ $entrie->material_type }}</td>
							<td>{{ $entrie->material_quantity }}</td>
							<td>{{ $entrie->unit->code }}</td>
						@else
							<td>N/A</td>
							<td>N/A</td>
							<td>N/A</td>
						@endif
						<td>{{ $entrie->vehicle }} {{ $entrie->vehicle_plate }}</td>
						<td>{{ $entrie->driver_name}}  {{ $entrie->driver_id}}</td>
						<td>
							@if( $entrie->person_observations != '')
								Persona: {{ $entrie->person_observations }}.
							@endif
							@if($entrie->material_observations != '')
								Material: {{ $entrie->material_observations }}.
							@endif
							@if($entrie->vehicle_observations != '')
								Vehículo: {{ $entrie->vehicle_observations }}.
							@endif
						</td>
						<td align="right" data-toggle="tooltip" data-placement="top" title="Editar" data-container="body"><a href="/entry/{{$entrie->id}}/edit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></td>
               			<td align="right" data-toggle="tooltip" data-placement="top" title="Eliminar" data-container="body"><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$entrie->id}}"><span class="glyphicon glyphicon-trash"></span></button>
                		</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div class="form-group col-xs-2 col-sm-12" align="right">
	        <a href="/entry/print" class="btn btn-info btn-xs" role="button" data-toggle="tooltip" data-placement="top" title="Imprimir" data-container="body"><span class="glyphicon glyphicon-print"></a>
	    </div>
	</div>
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip(); 
		});

		$('#myModalDelete').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var entry_id = button.data('id')

		  $.get('/entry/getEntry/' + entry_id, function(response){
  			$('label[id="name"]').text(response.name)  			
		  })
		  $('form[id="delete"]').attr('action','entry/' + entry_id)
		});
	</script>
@stop