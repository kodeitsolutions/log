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
							<dd class="col-sm-9" id="driver_id"></dd>
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

@section('table')
	<div class="col-md-12">
		<h3 class="text-info" align="center">LOG DE REGISTROS AL {{ $date }} </h3>
		<table class="table table-striped log">
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
				</tr>
			</thead>
			<tbody>
				@foreach($entries as $index => $entrie)
					<tr id="{{ $index + 1 }}">
						<td>{{ $index + 1 }}</td>
						<td>{{ $entrie->date->format('d/m/Y')}}</td>
						<td>{{ $entrie->time }}</td>
						<td>{{ $entrie->user->name }}</td>
						<td>{{ $entrie->operation->name }}</td>
						<td>{{ $entrie->category->name }}</td>
						<td>{{ $entrie->company->name }}</td>
						<td>{{ $entrie->destination }}</td>						
						@if( $entrie->category->person == 1 )
							<td>{{ $entrie->person_name }}</td>
						@endif
						@if( $entrie->category->material == 1)
							<td>{{ $entrie->material_type }}</td>							
						@endif
						@if( $entrie->category->combined == 1)
							<td>Persona: {{ $entrie->person_name }}. <br>
							Material: {{ $entrie->material_type }}</td>
						@endif						
						<td>
							@if( $entrie->person_observations != '')
								Persona: {{ $entrie->person_observations }}.<br>
							@endif
							@if($entrie->material_observations != '')
								Material: {{ $entrie->material_observations }}.<br>
							@endif
							@if($entrie->vehicle_observations != '')
								Vehículo: {{ $entrie->vehicle_observations }}.<br>
							@endif
						</td>
						<td align="right" data-toggle="tooltip" data-placement="top" title="Ver mas" data-container="body"><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModalInfo" data-id="{{$entrie->id}}"><span class="glyphicon glyphicon-eye-open"></span></button>
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
		  $('form[id="delete"]').attr('action','/entry/' + entry_id)
		});

		$('#myModalInfo').on('show.bs.modal', function (event) {
        	var button = $(event.relatedTarget) // Button that triggered the modal
        	var entry_id = button.data('id')
        	var tr = button.closest('tr').attr('id')
        	$('h4[id="info').text('Datos del registro N° ' + tr)
        	

        	$.get('/entry/getEntry/' + entry_id, function(response){      

        		$('dd[id="person_name').text(response.person_name)
	          	$('dd[id="person_id').text(response.person_id)
	          	$('dd[id="person_occupation').text(response.person_occupation)
	          	$('dd[id="person_company').text(response.person_company)  
	          	$('dd[id="person_observations').text(response.person_observations)  

	          	$('dd[id="material_type').text(response.material_type)
	          	$('dd[id="material_quantity').text(response.material_quantity)
	          	var unit_id = response.unit_id
	          	$.get('/unit/getUnit/' + unit_id, function(unit){
	          		console.log(unit)
	          		$('dd[id="unit').text(unit.code + ' - ' + unit.name)
	          	})
	          	$('dd[id="material_observations').text(response.material_observations)

	          	$('dd[id="vehicle').text(response.vehicle)
	          	$('dd[id="vehicle_plate').text(response.vehicle_plate)
	          	$('dd[id="driver_name').text(response.driver_name)
	          	$('dd[id="driver_id').text(response.driver_id)
	          	$('dd[id="vehicle_observations').text(response.vehicle_observations)

        		$.get('/category/getCategory/' + response.categorie_id, function(category){
        			if(category.person == 1){
			        	$("#vehicle").hide()
			            $("#person").show()
			            $('#material').hide()
			        }

			        if(category.material == 1){
			        	$("#vehicle").hide()
			            $('#material').show()
			            $("#person").hide()
			        }

			        if(category.vehicle == 1){           
			            $("#vehicle").show()
			        }  

			        if(category.combined == 1){
			            $("#vehicle").hide()
			            $("#person").show()
			            $('#material').show()
			            $("#vehicle").show()
			        }
        		})	          	
	        })
    	});
	</script>
@stop