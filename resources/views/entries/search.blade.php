@extends('layout')

@section('sidebar')
	@include('entries.sidebar')	
@stop

@section('content')
    <div class="row">
      <div class="col-sm-10">
        <h4>Búsqueda de registros:</h4>
        <form method="GET" action="/entry/searching">
          {{ csrf_field()}}
          <div class="form-group col-md-10">
            <label class="control-label col-md-3">Fecha:</label>
            <div class="col-md-4">
              <input type="text" name="date_from" id="date_from" value="01/01/2017" class="form-control">
            </div>
            <div class="col-md-4">
              <input type="text" name="date_to" id="date_to" value="{{ $date }}" class="form-control">

            </div>
          </div>

          <div class="form-group col-md-10">
            <label class="control-label col-md-3">Usuario:</label>
            <div class="col-md-8">
              <select  id="user" class="form-control input-sm" name="user">
                <option selected disabled>Seleccione el usuario</option>
                @foreach($users as $user)
                   <option value="{{ $user->id }}" @if (old('user_id') == $user->id) selected @endif>{{ $user->name }}</option>
                @endforeach
              </select>         
            </div>
          </div>

          <div class="form-group col-md-10">
            <label class="control-label col-md-3">Tipo de Movimiento:</label>
            <div class="col-md-8">
              <select  id="operation" class="form-control input-sm" name="operation">
                <option selected disabled>Seleccione el tipo de movimiento</option>
                @foreach($operations as $operation)
                  <option value="{{ $operation->id }}">{{ $operation->name }}</option>
                @endforeach
              </select>         
            </div>
          </div>

          <div class="form-group col-md-10">
            <label class="control-label col-md-3">Categoría:</label>
            <div class="col-md-8">
                <select id="category" class="form-control input-sm" name="category" >
                  <option selected disabled>Seleccione la categoría</option>                    
                  @foreach($categories as $category)
                     <option value="{{ old('category') }}">{{ $category->name }}</option>
                  @endforeach                  
                </select>  
            </div>
          </div>

          <div class="form-group col-md-10">
            <label class="control-label col-md-3">Empresa causante de Mov.:</label>
            <div class="col-md-8">
              <select id="company" class="form-control input-sm" name="company">
                <option selected disabled>Seleccione la empresa</option>
                @foreach($companies as $company)
                   <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach                     
              </select>  
            </div>
          </div>

          <div class="form-group col-xs-2 col-sm-10" align="right">
            <button type="submit" class="btn btn-primary">Buscar</button>
          </div>
        </form>
      </div>
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
        $("#date_from").datepicker();
        $("#date_to").datepicker();
      });

      $('#search').on('change',function(){

        selection = $(this).val()

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
      })
    });
  </script>
@stop