@extends('layout')

@section('form')
  <div class=" col-md-12">
        <form method="POST" action="/entry/add">
          {{ csrf_field()}}
          <div class="form-group col-xs-2 col-sm-12 {{ $errors->has('operation') ? ' has-error' : '' }} row" >
            <label class="control-label col-md-2">Tipo de Movimiento:</label>
            <div class="col-md-10">
                <select  id="operation" class="form-control input-sm" name="operation" required>
                    <option selected disabled>Seleccione el tipo de movimiento</option>
                    @foreach($operations as $operation)
                       <option value="{{ $operation->name }}">{{ $operation->name }}</option>
                    @endforeach
                </select>
            </div>                          
          </div>
          <div class="form-group col-xs-2 col-sm-12 {{ $errors->has('type') ? ' has-error' : '' }} row">
              <label class="control-label col-md-2">Categoría:</label>
              <div class="col-md-10">
                  <select id="type" class="form-control input-sm" name="type" required>
                    <option selected disabled>Seleccione la categoría</option>
                    <option value="Todos">Todos</option>
                    @foreach($categories as $category)
                       <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach                     
                  </select>  
              </div>
          </div>
          <div class="form-group col-xs-2 col-sm-12 {{ $errors->has('company') ? ' has-error' : '' }} row">
              <label class="control-label col-md-2">Empresa:</label>
              <div class="col-md-10">
                  <select id="company" class="form-control input-sm" name="company" required>
                    <option selected disabled>Seleccione la empresa</option>
                    @foreach($companies as $company)
                       <option value="{{ $company->name }}">{{ $company->name }}</option>
                    @endforeach                     
                  </select>  
              </div>
          </div>
          <div class="form-group col-xs-2 col-sm-12 {{ $errors->has('destination') ? ' has-error' : '' }} row">
              <label class="control-label col-md-2">Destino / Origen:</label>
              <div class="col-md-10"> 
                  <input type="text" class="form-control" name="destination" id="destination" placeholder="Ingrese el destino." value="{{ old('destination') }}" required>
              </div>
          </div>
          <div class="form-group col-xs-2 col-sm-12 row">
            <label class="control-label col-md-2">Hora:</label>
            <div class="col-md-2">
              <select name="hour" class="form-control input-sm">
                <option selected disabled>Hora</option>
                @for($i = 1; $i <= 12; $i++)
                  <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>                   
            </div>
            <div class="col-md-2">
              <select name="minute" class="form-control input-sm">
                <option selected disabled>Minutos</option>
                @for($i = 0; $i <=59 ; $i++)
                  <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>                   
            </div>
            <div class="col-md-2">
              <select name="ampm" class="form-control input-sm">
                <option value="AM">AM</option>
                <option value="PM">PM</option>                    
              </select>                   
            </div>                
          </div> 
          <div class="form-group col-xs-2 col-sm-12" id="person" style="display: none">
            <h4><span class="label label-default">Datos de la persona</span></h4>
            <div class="row">
              <label class="control-label col-md-2">Nombre:</label>
              <div class="col-md-10 {{ $errors->has('person_name') ? ' has-error' : '' }}"> 
                <input type="text" class="form-control" name="person_name" id="person_name" placeholder="Ingrese el nombre de la persona." value="{{ old('person_name') }}" >
              </div>
            </div>
            
            <div class="row">
              <label class="control-label col-md-2">Cédula:</label>
              <div class="col-md-10"> 
                <input type="text" class="form-control" name="person_id" id="person_id" placeholder="Ingrese la cédula de la persona (solo números)." value="{{ old('person_id') }}" >
              </div>
            </div>
            
            <div class="row">
              <label class="control-label col-md-2">Ocupación:</label>
              <div class="col-md-10"> 
                <input type="text" class="form-control" name="person_occupation" id="person_occupation" placeholder="Ingrese la ocupación de la persona." value="{{ old('person_occupation') }}" >
              </div>
            </div>                            
          </div>          

          <div class="form-group col-xs-2 col-sm-12" id="material" style="display: none">
            <h4><span class="label label-default">Datos del material</span></h4>
            <div class="row">
              <label class="control-label col-md-2">Descripción del material:</label>
              <div class="col-md-10"> 
                <input type="text" class="form-control" name="material_type" id="material_type" placeholder="Ingrese la descripción del material." value="{{ old('material_type') }}" >                       
              </div>
            </div>
            <div class="row">
              <div class="{{ $errors->has('material_quantity') ? ' has-error' : '' }} col-md-12 row" >
                <label class="control-label col-md-2">Cantidad de material:</label>
                <div class="col-md-5"> 
                  <input type="numeric" class="form-control" name="material_quantity" id="material_quantity" placeholder="Ingrese la cantidad de material." value="{{ old('material_quantity') }}" >
                </div>
                <div class="col-md-4"> 
                  <select id="material_unit" class="form-control input-sm" name="material_unit" required>
                    <option selected disabled>Seleccione la unidad</option>
                    @foreach($units as $unit)
                      <option value="{{ $unit->code }}">{{ $unit->code }}</option>
                    @endforeach                     
                  </select>
                </div>
              </div>              
            </div>
          </div>

          <div class="form-group col-xs-2 col-sm-12" id="vehicle" style="display: none">
            <h4><span class="label label-default">Datos del vehículo</span></h4>
            <div class="row">
              <label class="control-label col-md-2">Descripción del vehículo:</label>
              <div class="col-md-10"> 
                <input type="text" class="form-control" name="vehicle" id="vehicle" placeholder="Ingrese la descripción del vehículo." value="{{ old('vehicle') }}" >
              </div>
            </div>
            
            <div class="row">
              <label class="control-label col-md-2">Placa:</label>
              <div class="col-md-10"> 
                <input type="text" class="form-control" name="vehicle_plate" id="vehicle_plate" placeholder="Ingrese la placa del vehículo." value="{{ old('vehicle_plate') }}" >
              </div>
            </div>            
          </div>

          <div class="col-md-10">
            @if($errors->any())
              <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </div>
            @endif
          </div>
          <div class="form-group col-xs-2 col-sm-12" align="right">
                <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
    </div>
@stop

@section('script')
	<script type="text/javascript">
		$('#type').on('change',function(){

			selection = $(this).val()
		    switch(selection)
		    {
		       	case 'Persona':
		       		$("#vehicle").hide()
		        	$("#person").show()
		           	$("#vehicle").show()
		           	$('#material').hide()		           	
		           	break;
		       	case 'Material':
		       		$("#vehicle").hide()
		           	$('#material').show()
		           	$("#vehicle").show()
		           	$("#person").hide()		           	
		           	break;
		        case 'Todos':
		        	$("#vehicle").hide()
		        	$("#person").show()
		       	 	$('#material').show()
		        	$("#vehicle").show()
		        	break;
		   	}
		});
	</script>
@stop