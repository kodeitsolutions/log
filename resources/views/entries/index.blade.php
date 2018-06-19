@extends('layout')

@section('modal-delete')
	<div id="myModalDelete" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title" id="info">Eliminar registro</h4>
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

@section('modal-info')
	<div id="myModalInfo" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title" id="info">Datos del registro</h4>
				</div>
				
				
				<div class="modal-body">
					<div id="person">
						<h4><span class="label label-default">Datos de la persona</span></h4>
						<dl class="row">
							<dt class="col-sm-3">Nombre:</dt>
							<dd class="col-sm-9" id="person_name"></dd><br>
							<dt class="col-sm-3">Cédula:</dt>
							<dd class="col-sm-9" id="person_id"></dd><br>
							<dt class="col-sm-3">Ocupación:</dt>
							<dd class="col-sm-9" id="person_occupation"></dd><br>
							<dt class="col-sm-3">Empresa:</dt>
							<dd class="col-sm-9" id="person_company"></dd>
							<dt class="col-sm-3">Observaciones:</dt>
							<dd class="col-sm-9" id="person_observations"></dd>
						</dl>
					</div>
						
					<div id="material">
						<h4><span class="label label-default">Datos del material</span></h4>
						<dl class="row">
							<dt class="col-sm-3">Descripción:</dt>
							<dd class="col-sm-9" id="material_type"></dd><br>
							<dt class="col-sm-3">Tipo de Material:</dt>
							<dd class="col-sm-9" id="material"></dd><br>
							<dt class="col-sm-3">Cantidad:</dt>
							<dd class="col-sm-9" id="material_quantity"></dd><br>
							<dt class="col-sm-3">Unidad</dt>
							<dd class="col-sm-9" id="unit"></dd>
							<dt class="col-sm-3">Observaciones:</dt>
							<dd class="col-sm-9" id="material_observations"></dd>
						</dl>
					</div>				
					
					<div id="vehicle">
						<h4><span class="label label-default">Datos del vehículo</span></h4>
						<dl class="row">
							<dt class="col-sm-3">Descripción:</dt>
							<dd class="col-sm-9" id="vehicle"></dd><br>
							<dt class="col-sm-3">Placa:</dt>
							<dd class="col-sm-9" id="vehicle_plate"></dd><br>
							<dt class="col-sm-3">Chofer:</dt>
							<dd class="col-sm-9" id="driver_name"></dd><br>
							<dt class="col-sm-3">Cédula:</dt>
							<dd class="col-sm-9" id="driver_id"></dd><br>
							<dt class="col-sm-3">Observaciones:</dt>
							<dd class="col-sm-9" id="vehicle_observations"></dd>
						</dl>
					</div>
					
		        </div>
		        <div class="modal-footer form-group">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>		
			</div>			
		</div>		
	</div>
@stop

@section('modal-email')
	<div id="myModalEmail" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title" id="email">Enviar por correo</h4>
				</div>

				<form method="POST" action="/entry/send" id="email">		        	
		          	{{ csrf_field() }}
		            <div class="modal-body form-group">
		            	<label class="control-label">Ingrese el correo del destinatario:</label>
		                <div class="form-group">
		                	<input type="email" class="form-control" name="email" id="email" value="" autofocus required>
		                </div>
		            </div>
		            <div class="modal-footer form-group">
		             	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		              	<button type="submit" class="btn btn-primary btn-edit">Enviar</button>
		            </div>
		        </form>     
			</div>			
		</div>		
	</div>
@stop

@section('table')
	
	@if(!empty($date_from))
		<div class="row">
			<h3 class="text-info" align="center">LOG DE REGISTROS DESDE {{ $date_from }} HASTA {{ $date_to }} </h3>
		</div>
	@else
		<div class="row">
			<h3 class="text-info" align="center">LOG DE REGISTROS AL {{ $date }} </h3>
		</div>
	@endif

	<div class="col-md-12" align="right">  
		<div class="row">
			<a href="/entry/add" class="btn btn-success btn-xs" role="button"><span class="glyphicon glyphicon-plus"></span> Agregar </a>
		</div>   	
	</div>
		
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped" id="log">			
				<thead>
					<tr>
						<th>#</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Usuario</th>
						<th>Movimiento</th>
						<th>Categoría</th>
						<th>Empresa</th>
						<th>Destino / Origen</th>
						<th>Datos</th>
						<th>Observaciones</th>
						<th colspan="4" class="text-center">Operación</th>
					</tr>
				</thead>
				<tbody>
					@foreach($entries as $index => $entry)
						<tr id="{{ $index + 1 }}">
							<th scope="row"> {{ $index + 1 }}</th>
							<td>{{ $entry->dateView() }}</td>
							<td>{{ $entry->timeView() }}</td>
							<td>{{ $entry->user->name }}</td>
							<td>{{ $entry->operation->name }}</td>
							<td>{{ $entry->category->name }}</td>
							<td>{{ $entry->company->name }}</td>
							<td>{{ $entry->destination }}</td>						
							@if( $entry->category->person == 1 )
								<td>{{ $entry->person_name }}</td>
							@endif
							@if( $entry->category->material == 1)
								<td>{{ $entry->material_type }}</td>							
							@endif
							@if( $entry->category->combined == 1)
								<td>Persona: {{ $entry->person_name }}. <br>
								Material: {{ $entry->material_type }}</td>
							@endif						
							<td>
								@if( !empty($entry->person_observations))
									Persona: {{ $entry->person_observations }}.<br>
								@endif
								@if( !empty($entry->material_observations))
									Material: {{ $entry->material_observations }}.<br>
								@endif
								@if( !empty($entry->vehicle_observations))
									Vehículo: {{ $entry->vehicle_observations }}.<br>
								@endif
							</td>
							
							<td align="center"><span data-toggle="tooltip" data-placement="top" title="Ver mas" data-container="body"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModalInfo" data-id="{{$entry->id}}" id="info"><span class="glyphicon glyphicon-eye-open"></span></button></span></td>
							<td align="center"><span data-toggle="tooltip" data-placement="top" title="Editar" data-container="body"><a href="/entry/{{$entry->id}}/edit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></span></td>
	               			<td align="center"><span data-toggle="tooltip" data-placement="top" title="Eliminar" data-container="body"><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$entry->id}}"><span class="glyphicon glyphicon-trash"></span></button></span></td>
	                		<td align="center"><span data-toggle="tooltip" data-placement="top" title="Duplicar" data-container="body"><a href="/entry/{{$entry->id}}/duplicate" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-duplicate"></span></a></span></td>
						</tr>
					@endforeach				
				</tbody>			
			</table>
		</div>
	</div>
	<div class="text-center">
		{{ $entries->appends(Request::except('page'))->render() }}
	</div>
		
	<div class="col-md-12" align="right" id="button-table">
		<div class="row">
	        <a href="/entry/print/{{ !empty($date_from) ? str_replace('/','-',$date_from).'_'.str_replace('/','-',$date_to) : str_replace('/','-',$date) }}" target="blank" class="btn btn-info btn-xs" role="button" data-toggle="tooltip" data-placement="top" title="Imprimir" data-container="body" @if($entries->isEmpty()) disabled @endif><span class="glyphicon glyphicon-print"></a>
	        <button class="btn btn-basic btn-xs" data-toggle="tooltip" data-placement="top" title="e-mail" data-container="body" @if($entries->isEmpty()) disabled @endif><span class="glyphicon glyphicon-envelope" data-toggle="modal" data-target="#myModalEmail"></button>
	    </div>
	</div>
	
@stop

@section('script')
	<script>
		$('#myModalDelete').on('show.bs.modal', function (event) {
		  	var button = $(event.relatedTarget);
		  	var entry_id = button.data('id');
		  	var tr = button.closest('tr').attr('id');

		  	modalDeleteEntry(entry_id,tr);        	
		});

		$('#myModalInfo').on('show.bs.modal', function (event) {
        	var button = $(event.relatedTarget);
        	var entry_id = button.data('id');
        	var tr = button.closest('tr').attr('id');

        	modalInfo(entry_id,tr);
    	});
	</script>
@stop