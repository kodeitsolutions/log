@extends('layout')

@section('form')
  <div class=" col-md-12">
        <form method="POST" action="/entry/add">
          {{ csrf_field()}}
          <div class="form-group col-xs-2 col-sm-12 {{ $errors->has('operation_id') ? ' has-error' : '' }} row" >
            <label class="control-label col-md-2">Tipo de Movimiento:</label>
            <div class="col-md-10">
                <select  id="operation_id" class="form-control input-sm" name="operation_id" required>
                    <option selected disabled>Seleccione el tipo de movimiento</option>
                    @foreach($operations as $operation)
                       <option value="{{ $operation->id }}">{{ $operation->name }}</option>
                    @endforeach
                </select>
            </div>                          
          </div>
          <div class="form-group col-xs-2 col-sm-12 {{ $errors->has('categorie_id') ? ' has-error' : '' }} row">
              <label class="control-label col-md-2">Categoría:</label>
              <div class="col-md-10">
                  <select id="categorie_id" class="form-control input-sm" name="categorie_id" required>
                    <option selected disabled>Seleccione la categoría</option>                    
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}" name="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach                   
                  </select>  
              </div>
          </div>
          <div class="form-group col-xs-2 col-sm-12 {{ $errors->has('companie_id') ? ' has-error' : '' }} row">
              <label class="control-label col-md-2">Empresa causante de Mov.:</label>
              <div class="col-md-10">
                  <select id="companie_id" class="form-control input-sm" name="companie_id" required>
                    <option selected disabled>Seleccione la empresa</option>
                    @foreach($companies as $company)
                      <option value="{{ $company->id }}">{{ $company->name }}</option>
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

          <div class="form-group col-xs-2 col-sm-12 {{ $errors->has('date') ? ' has-error' : '' }} row">
              <label class="control-label col-md-2">Fecha:</label>
              <div class="col-md-10"> 
                  <input type="date" class="form-control" name="date" id="date" value="{{ $date }}" required>
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

            <div class="row">
              <label class="control-label col-md-2">Empresa:</label>
              <div class="col-md-10"> 
                <input type="text" class="form-control" name="person_company" id="person_company" placeholder="Ingrese la empresa a la que pertenece la persona." value="{{ old('person_company') }}" >
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
              <div class="{{ $errors->has('unit_id') ? ' has-error' : '' }} col-md-12 row" >
                <label class="control-label col-md-2">Cantidad de material:</label>
                <div class="col-md-5"> 
                  <input type="numeric" class="form-control" name="material_quantity" id="material_quantity" placeholder="Ingrese la cantidad de material." value="{{ old('material_quantity') }}" >
                </div>
                <div class="col-md-4"> 
                  <select id="unit_id" class="form-control input-sm" name="unit_id" required>
                    <option selected disabled>Seleccione la unidad</option>
                    @foreach($units as $unit)
                      <option value="{{ $unit->id }}">{{ $unit->code }}</option>
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

            <div class="row">
              <label class="control-label col-md-2">Nombre del Chofer:</label>
              <div class="col-md-10"> 
                <input type="text" class="form-control" name="driver_name" id="driver_name" placeholder="Ingrese el nombre del chofer." value="{{ old('driver_name') }}" >
              </div>
            </div>      

            <div class="row">
              <label class="control-label col-md-2">Cédula del Chofer:</label>
              <div class="col-md-10"> 
                <input type="text" class="form-control" name="driver_id" id="driver_id" placeholder="Ingrese la cédula del chofer." value="{{ old('driver_id') }}" >
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
		$('#categorie_id').on('change',function(){

			selection = $('#categorie_id option:selected').text()
      
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
        case 'Persona-Material':
        	$("#vehicle").hide()
        	$("#person").show()
       	 	$('#material').show()
        	$("#vehicle").show()
        	break;
   	  }
		});
	</script>
@stop