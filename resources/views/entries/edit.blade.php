@extends('layout')

@section('form')
	<h4>Editar Registro</h4>

	<form method="POST" action="/entry/{{ $entry->id }}" >
		{{ method_field('PATCH') }}
		{{ csrf_field() }}

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Fecha:</label>
			<div class="col-md-6">
				<input type="text" name="date" id="date" class="form-control" value="{{ $entry->date->format('d/m/Y') }}">	
			</div>	
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Hora</label>
			<div class="col-md-6">
				<input type="text" name="time" class="form-control" value="{{ $entry->time }}">	
			</div>			
		</div>

		<div class="form-group col-xs-2 col-sm-9" >
            <label class="control-label col-md-3">Usuario:</label>
            <div class="col-md-6">
                <select  id="user_id" class="form-control input-sm" name="user_id">
                    @foreach($users as $user)
                    	@if( $user->id  ==  $entry->user_id )
                       		<option selected value="{{ $user->id }}">{{ $user->name }}</option>
                       	@else
                       		<option value="{{ $user->id }}">{{ $user->name }}</option>
                       	@endif
                    @endforeach
                </select>
            </div>                          
        </div>

		<div class="form-group col-xs-2 col-sm-9" >
            <label class="control-label col-md-3">Tipo de Movimiento:</label>
            <div class="col-md-6">
                <select  id="operation_id" class="form-control input-sm" name="operation_id">
                    @foreach($operations as $operation)
                    	@if( $operation->id  ==  $entry->operation_id )
                       		<option selected value="{{ $operation->id }}">{{ $operation->name }}</option>
                       	@else
                       		<option value="{{ $operation->id }}">{{ $operation->name }}</option>
                       	@endif
                    @endforeach
                </select>
            </div>                          
        </div>

        <div class="form-group col-xs-2 col-sm-9" >
            <label class="control-label col-md-3">Categoría:</label>
            <div class="col-md-6">
                <select  id="categorie_id" class="form-control input-sm" name="categorie_id">
                    @foreach($categories as $category)
                    	@if( $category->id  ==  $entry->categorie_id )
                       		<option selected value="{{ $category->id }}">{{ $category->name }}</option>
                       	@else
                       		<option value="{{ $category->id }}">{{ $category->name }}</option>
                       	@endif
                    @endforeach
                </select>
            </div>                          
        </div>

        <div class="form-group col-xs-2 col-sm-9" >
            <label class="control-label col-md-3">Empresa:</label>
            <div class="col-md-6">
                <select  id="companie_id" class="form-control input-sm" name="companie_id">
                    @foreach($companies as $company)
                    	@if( $company->id  ==  $entry->companie_id )
                       		<option selected value="{{ $company->id }}">{{ $company->name }}</option>
                       	@else
                       		<option value="{{ $company->id }}">{{ $company->name }}</option>
                       	@endif
                    @endforeach
                </select>
            </div>                          
        </div>

        <div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Destino / Origen:</label>
			<div class="col-md-6">
				<input type="text" name="destination" class="form-control" value="{{ $entry->destination }}">	
			</div>			
		</div>

		<div class="col-xs-2 col-sm-9">
			<h4><span class="label label-default">Datos de la persona</span></h4>
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Nombre:</label>
			<div class="col-md-6">
				@if ( $entry->person_name == '')
					<input type="text" name="person_name" class="form-control" value="">
				@else
					<input type="text" name="person_name" class="form-control" value="{{ $entry->person_name }}">
				@endif
			</div>			
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Cédula:</label>
			<div class="col-md-6">
				@if ( $entry->person_id == '')
					<input type="text" name="person_id" class="form-control" value="">
				@else
					<input type="text" name="person_id" class="form-control" value="{{ $entry->person_id }}">
				@endif					
			</div>			
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Ocupación:</label>
			<div class="col-md-6">
				@if ( $entry->person_occupation == '')
					<input type="text" name="person_occupation" class="form-control" value="">
				@else
					<input type="text" name="person_occupation" class="form-control" value="{{ $entry->person_occupation }}">
				@endif	
			</div>			
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Empresa:</label>
			<div class="col-md-6">
				@if ( $entry->person_company == '')
					<input type="text" name="person_company" class="form-control" value="">
				@else
					<input type="text" name="person_company" class="form-control" value="{{ $entry->person_company }}">
				@endif	
			</div>			
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Observaciones:</label>
			<div class="col-md-6">
				@if ( $entry->person_observations == '')
					<textarea class="form-control" name="person_observations"></textarea>
				@else
					<textarea class="form-control" name="person_observations">{{ $entry->person_observations }}</textarea>
				@endif
			</div>			
		</div>

		<div class="col-xs-2 col-sm-9">
			<h4><span class="label label-default">Datos del material</span></h4>
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Material:</label>
			<div class="col-md-6">
				@if ( $entry->material_type == '')
					<input type="text" name="material_type" class="form-control" value="">
				@else
					<input type="text" name="material_type" class="form-control" value="{{ $entry->material_type }}">
				@endif
			</div>			
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Cantidad:</label>
			<div class="col-md-6">
				@if ( $entry->material_quantity == 0)
					<input type="text" name="material_quantity" class="form-control" value="">
				@else
					<input type="text" name="material_quantity" class="form-control" value="{{ $entry->material_quantity }}">
				@endif					
			</div>			
		</div>		

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Unidad:</label>
			<div class="col-md-6">				
				<select  id="unit_id" class="form-control input-sm" name="unit_id">
	                @foreach($units as $unit)
	                	@if ( is_null($entry->unit))
							<option selected disabled>Seleccione la unidad</option>
						@else
	                		@if( $unit->id  ==  $entry->unit_id )
	                   			<option selected value="{{ $unit->id }}">{{ $unit->code }}</option>
	                   		@else
	                   			<option value="{{ $unit->id }}">{{ $unit->code }}</option>
	                   		@endif
	                   	@endif
	                @endforeach
                </select>
			</div>			
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Observaciones:</label>
			<div class="col-md-6">
				@if ( $entry->material_observations == '')
					<textarea class="form-control" name="material_observations"></textarea>
				@else
					<textarea class="form-control" name="material_observations">{{ $entry->material_observations }}</textarea>
				@endif
			</div>			
		</div>

		<div class="col-xs-2 col-sm-9">
			<h4><span class="label label-default">Datos del vehículo</span></h4>
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Descripción:</label>
			<div class="col-md-6">
				<input type="text" name="vehicle" class="form-control" value="{{ $entry->vehicle }}">	
			</div>			
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Placa:</label>
			<div class="col-md-6">
				<input type="text" name="vehicle_plate" class="form-control" value="{{ $entry->vehicle_plate }}">	
			</div>			
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Nombre del chofer:</label>
			<div class="col-md-6">
				<input type="text" name="driver_name" class="form-control" value="{{ $entry->driver_name }}">	
			</div>			
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Cédula del chofer:</label>
			<div class="col-md-6">
				<input type="text" name="driver_id" class="form-control" value="{{ $entry->driver_id }}">	
			</div>			
		</div>

		<div class="form-group col-xs-2 col-sm-9">
			<label class="control-label col-md-3">Observaciones:</label>
			<div class="col-md-6">
				@if ( $entry->vehicle_observations == '')
					<textarea class="form-control" name="vehicle_observations"></textarea>
				@else
					<textarea class="form-control" name="vehicle_observations">{{ $entry->vehicle_observations }}</textarea>
				@endif
			</div>			
		</div>
		
		<div class="form-group col-xs-2 col-sm-9" align="right">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
	</form>
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){  
      		$.datepicker.regional['es'] = {
        		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        		weekHeader: 'Sm',
        		dateFormat: 'dd/mm/yy',
        		firstDay: 1,
        		isRTL: false,
        		showMonthAfterYear: false,
        		yearSuffix: ''
      		}

      		$.datepicker.setDefaults($.datepicker.regional['es'])

      		$(function () {
        		$("#date").datepicker();
      		})
		});
	</script>
@stop