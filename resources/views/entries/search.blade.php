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
              <input type="text" name="date_from" id="date_from" value="01/01/2017" class="form-control" required>
            </div>
            <div class="col-md-4">
              <input type="text" name="date_to" id="date_to" value="{{ old('date_to') }}" class="form-control" placeholder="{{ $date }}" required>
            </div>
          </div>

          <div class="form-group col-md-10">
            <label class="control-label col-md-3">Usuario:</label>
            <div class="col-md-8">
              <select  id="user" class="form-control input-sm" name="user_id">
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
              <select  id="operation" class="form-control input-sm" name="operation_id">
                <option selected disabled>Seleccione el tipo de movimiento</option>
                @foreach($operations as $operation)
                  <option value="{{ $operation->id }}" @if (old('operation_id') == $operation->id) selected @endif>{{ $operation->name }}</option>
                @endforeach
              </select>         
            </div>
          </div>

          <div class="form-group col-md-10">
            <label class="control-label col-md-3">Categoría:</label>
            <div class="col-md-8">
                <select id="category" class="form-control input-sm" name="categorie_id" >
                  <option selected disabled>Seleccione la categoría</option>                    
                  @foreach($categories as $category)
                     <option value="{{ $category->id }}" @if (old('categorie_id') == $category->id) selected @endif>{{ $category->name }}</option>
                  @endforeach                  
                </select>  
            </div>
          </div>

          <div class="form-group col-md-10">
            <label class="control-label col-md-3">Empresa causante de Mov.:</label>
            <div class="col-md-8">
              <select id="company" class="form-control input-sm" name="companie_id">
                <option selected disabled>Seleccione la empresa</option>
                @foreach($companies as $company)
                   <option value="{{ $company->id }}" @if (old('companie_id') == $company->id) selected @endif>{{ $company->name }}</option>
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
    });
  </script>
@stop