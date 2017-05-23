@extends('layout')

@section('form')
  <div class="col-md-12">      
    @if($entry->exists)
      <h3 class="text-info" align="center">EDITAR REGISTRO</h3>
      <br>
      <form method="POST" action="/entry/{{ $entry->id }}">
      {{ method_field('PATCH') }}
    @else
      <h3 class="text-info" align="center">AGREGAR REGISTRO</h3>
      <br>
      <form method="POST" action="/entry/add">
    @endif
    {{ csrf_field()}}
    <div class="form-group col-xs-2 col-sm-12 row">
      <label class="control-label col-md-2 {{ $errors->has('operation_id') ? ' has-error' : '' }}">Tipo de Movimiento:</label>
      <div class="col-md-10 {{ $errors->has('operation_id') ? ' has-error' : '' }}">
        <select  id="operation_id" class="form-control input-sm" name="operation_id" >
          <option selected disabled>Seleccione el tipo de movimiento</option>
          @foreach($operations as $operation)  
            <option value="{{ $operation->id }}" @if (old('operation_id', $entry->operation_id) == $operation->id) selected @endif>{{ $operation->name }}</option>
          @endforeach
        </select>
      </div>                          
    </div>
    <div class="form-group col-xs-2 col-sm-12 row">
      <label class="control-label col-md-2 {{ $errors->has('categorie_id') ? ' has-error' : '' }}">Categoría:</label>
      <div class="col-md-10 {{ $errors->has('categorie_id') ? ' has-error' : '' }}">
        <select id="categorie_id" class="form-control input-sm" name="categorie_id">
          <option selected disabled>Seleccione la categoría</option>                    
          @foreach($categories as $category)
            <option value="{{ $category->id }}" name="{{ $category->name }}" @if (old('categorie_id', $entry->categorie_id) == $category->id) selected @endif>{{ $category->name }}</option>
          @endforeach                   
        </select>  
      </div>
    </div>
    <div class="form-group col-xs-2 col-sm-12 row">
      <label class="control-label col-md-2 {{ $errors->has('companie_id') ? ' has-error' : '' }}">Empresa causante de Mov.:</label>
      <div class="col-md-10 {{ $errors->has('companie_id') ? ' has-error' : '' }}">
          <select id="companie_id" class="form-control input-sm" name="companie_id">
            <option selected disabled>Seleccione la empresa</option>                    
            @foreach($companies as $company)
              <option value="{{ $company->id }}" @if (old('companie_id', $entry->companie_id) == $company->id) selected @endif>{{ $company->name }}</option>
            @endforeach                   
          </select>  
      </div>
    </div>
    <div class="form-group col-xs-2 col-sm-12 row">
      <label class="control-label col-md-2 {{ $errors->has('destination') ? ' has-error' : '' }}">Destino / Origen:</label>
      <div class="col-md-10 {{ $errors->has('destination') ? ' has-error' : '' }}"> 
          <input type="text" class="form-control" name="destination" id="destination" placeholder="Ingrese el destino." value="{{ old('destination', $entry->destination) }}">
      </div>
    </div>   

    <div class="form-group col-xs-2 col-sm-12 row">
      <label class="control-label col-md-2">Fecha:</label>
      <div class="col-md-10"> 
        <input type="text" class="form-control" name="date" id="date" value="{{ old('date', $date) }}">
      </div>
    </div>            

    <div class="form-group col-xs-2 col-sm-12 row">
      <label class="control-label col-md-2  ">Hora:</label>
      <div class="col-md-4">
        <input type="text" name="time"  value="{{ old('time', $entry->time) }}" class="form-control time_element"/>
      </div>
    </div>

    <div class="col-md-10">
      @if($errors->any())
        <div class="alert alert-danger">
          <strong>Campos requeridos</strong>
        </div>
      @endif
    </div>

    <div class="form-group col-xs-2 col-sm-12 conditional" id="person">
      <h4><span class="label label-default">Datos de la persona</span></h4>
      <div class="row">
        <label class="control-label col-md-2 {{ $errors->has('person_name') ? ' has-error' : '' }}">Nombre:</label>
        <div class="col-md-10 {{ $errors->has('person_name') ? ' has-error' : '' }}"> 
          <input type="text" class="form-control" name="person_name" id="person_name" placeholder="Ingrese el nombre de la persona." value="{{ old('person_name', $entry->person_name) }}" >
        </div>
      </div>
      <br>
      <div class="row">
        <label class="control-label col-md-2  {{ $errors->has('person_id') ? ' has-error' : '' }}">Cédula:</label>
        <div class="col-md-10 {{ $errors->has('person_id') ? ' has-error' : '' }}"> 
          <input type="text" class="form-control" name="person_id" id="person_id" placeholder="Ingrese la cédula de la persona (solo números)." value="{{ old('person_id', $entry->person_id) }}" >
        </div>
      </div>
      <br>
      <div class="row">
        <label class="control-label col-md-2 {{ $errors->has('person_occupation') ? ' has-error' : '' }}">Ocupación:</label>
        <div class="col-md-10 {{ $errors->has('person_occupation') ? ' has-error' : '' }}"> 
          <input type="text" class="form-control" name="person_occupation" id="person_occupation" placeholder="Ingrese la ocupación de la persona." value="{{ old('person_occupation', $entry->person_occupation) }}" >
        </div>
      </div> 
      <br>
      <div class="row {{ $errors->has('person_company') ? ' has-error' : '' }}">
        <label class="control-label col-md-2">Empresa:</label>
        <div class="col-md-10"> 
          <input type="text" class="form-control" name="person_company" id="person_company" placeholder="Ingrese la empresa a la que pertenece la persona." value="{{ old('person_company', $entry->person_company) }}" >
        </div>
      </div>
      <br>
      <div class="row">
        <label class="control-label col-md-2">Observaciones:</label>
        <div class="col-md-10">
          <textarea class="form-control input-sm" name="person_observations" id="person_observations">{{ old('person_observations', $entry->person_observations)}}</textarea>
        </div>
      </div>                            
    </div>          

    <div class="form-group col-xs-2 col-sm-12 conditional" id="material">
      <h4><span class="label label-default ">Datos del material</span></h4>
      <div class="row">
        <label class="control-label col-md-2 {{ $errors->has('material_type') ? ' has-error' : '' }}">Descripción:</label>
        <div class="col-md-10 {{ $errors->has('material_type') ? ' has-error' : '' }}"> 
          <input type="text" class="form-control" name="material_type" id="material_type" placeholder="Ingrese la descripción del material." value="{{ old('material_type', $entry->material_type) }}" >                       
        </div>
      </div>      
      <br>
      <div class="row">
        <label class="control-label col-md-2 {{ $errors->has('material_type') ? ' has-error' : '' }}">Tipo de material:</label>
        <div class="col-md-10 {{ $errors->has('material_type') ? ' has-error' : '' }}"> 
          <select id="material_id" class="form-control input-sm" name="material_id">
            <option selected disabled>Seleccione el tipo de material</option>
            @foreach($materials as $material)  
              <option value="{{ $material->id }}" @if (old('material_id', $entry->material_id) == $material->id) selected @endif>{{ $material->code }} - {{ $material->name }}</option>
            @endforeach                     
          </select>                       
        </div>
      </div>      
      <br>     
      <div class="row">
        <div class="col-md-12 row" >
          <label class="control-label col-md-2 {{ $errors->has('material_quantity') || $errors->has('unit_id') ? ' has-error' : '' }}">Cantidad:</label>
          <div class="col-md-7 {{ $errors->has('material_quantity') ? ' has-error' : '' }}"> 
            <input type="numeric" class="form-control" name="material_quantity" id="material_quantity" placeholder="Ingrese la cantidad de material." value="{{ old('material_quantity', $entry->material_quantity) }}" align="right">
          </div>
          <div class="col-md-3 {{ $errors->has('unit_id') ? ' has-error' : '' }}" align="right"> 
            <select id="unit_id" class="form-control input-sm" name="unit_id">
              <option selected disabled>Seleccione la unidad</option>
              @foreach($units as $unit)
                <option value="{{ $unit->id }}" @if (old('unit_id', $entry->unit_id) == $unit->id) selected @endif>{{ $unit->code }} - {{ $unit->name }}</option>
              @endforeach                     
            </select>
          </div>
        </div>              
      </div>
      <br>
      <div class="row">
        <label class="control-label col-md-2">Observaciones:</label>
        <div class="col-md-10">
          <textarea class="form-control input-sm" name="material_observations" id="material_observations">{{ old('material_observations', $entry->material_observations)}}</textarea>
        </div>
      </div>            
    </div>

    <div class="form-group col-xs-2 col-sm-12 conditional" id="vehicle">
      <h4><span class="label label-default">Datos del vehículo</span></h4>
      <div class="row">
        <label class="control-label col-md-2">Descripción:</label>
        <div class="col-md-10"> 
          <input type="text" class="form-control" name="vehicle" id="vehicle" placeholder="Ingrese la descripción del vehículo." value="{{ old('vehicle', $entry->vehicle) }}" >
        </div>
      </div>
      <br>
      <div class="row">
        <label class="control-label col-md-2">Placa:</label>
        <div class="col-md-10"> 
          <input type="text" class="form-control" name="vehicle_plate" id="vehicle_plate" placeholder="Ingrese la placa del vehículo." value="{{ old('vehicle_plate', $entry->vehicle_plate) }}" >
        </div>
      </div>        
      <br>
      <div class="row">
        <label class="control-label col-md-2">Nombre del Chofer:</label>
        <div class="col-md-10"> 
          <input type="text" class="form-control" name="driver_name" id="driver_name" placeholder="Ingrese el nombre del chofer." value="{{ old('driver_name', $entry->driver_name) }}" >
        </div>
      </div>      
      <br>
      <div class="row">
        <label class="control-label col-md-2">Cédula del Chofer:</label>
        <div class="col-md-10"> 
          <input type="text" class="form-control" name="driver_id" id="driver_id" placeholder="Ingrese la cédula del chofer." value="{{ old('driver_id', $entry->driver_id) }}" >
        </div>
      </div>
      <br>
      <div class="row">
        <label class="control-label col-md-2">Observaciones:</label>
        <div class="col-md-10">
          <textarea class="form-control input-sm" name="vehicle_observations" id="vehicle_observations">{{ old('vehicle_observations', $entry->vehicle_observations) }}</textarea>
        </div>
      </div>
    </div>
        
      <div class="form-group col-xs-2 col-sm-12" align="right">
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </form>
  </div>
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
      };
      $.datepicker.setDefaults($.datepicker.regional['es']);
      $(function () {
        $("#date").datepicker();
      });

      $(".time_element").timepicki();

      category()
      $('#categorie_id').change(category)

      function category(){
        var  selection  = $('#categorie_id option:selected').val()      
           
        $.get('/category/getCategory/' + selection, function(response){        
          if(response.person == 1){            
            $('#material').hide()
            $("#person").show()            
          }

          if(response.material == 1){
            $("#person").hide()
            $('#material').show()            
          }

          if(response.vehicle == 1){           
            $("#vehicle").show()
          }  

          if(response.combined == 1){
            $("#person").show()
            $('#material').show()
            $("#vehicle").show()
          }         
        })
      }                
    });
  
	</script>
@stop