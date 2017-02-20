@extends('layout')

@section('sidebar')
	@include('entries.sidebar')	
@stop

@section('content')
    <div class="row">
      <div class="col-sm-10">
        <h4>Búsqueda de registros:</h4>
        <form method="GET" action="/entry/searching">
          	<div class="form-group col-xs-2 col-sm-8 {{ $errors->has('search') ? ' has-error' : '' }}">
            	<label>Buscar por:</label>
              <select  id="search" class="form-control input-sm" name="search" required>
                  <option value="0" selected disabled>Seleccione el parámetro de búsqueda</option>
                  <option value="date">Fecha</option>
                  <option value="user">Usuario</option>
                  <option value="operation">Movimiento</option>
                  <option value="type">Categoría</option>
                  <option value="company">Empresa</option>
                  <option value="destination">Destino / Origen</option>
              </select>
              @if ($errors->has('search'))
                <span class="help-block">
                  <strong>{{ $errors->first('search') }}</strong>
                </span>
              @endif                  
          	</div>

          	<div class="form-group col-xs-2 col-sm-8" id="input-text" style="display: none">
                <input type="text" class="form-control" name="value_text" placeholder="Buscar..."> 
            </div>
            
            <div class="form-group col-xs-2 col-sm-8" id="input-date" style="display: none">
                <input type="date" class="form-control" name="value_date" id="date">
            </div>

          <div class="form-group col-xs-2 col-sm-8" align="right">
            <button type="submit" class="btn btn-primary">Buscar</button>
          </div>
        </form>
      </div>
    </div>
@stop

@section('script')
  <script type="text/javascript">
    $('#search').on('change',function(){

      selection = $(this).val()
      console.log(selection)

      switch(selection)
      {
        case 'date':
          $("#input-text").hide() 
          $("#input-date").show()               
          break
        default:
          $("#input-date").hide()
          $("#input-text").show()
      }    
    });
  </script>
@stop