@extends('layout')

@section('modal-info')
  <div id="myModalHours" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar registro</h4>
        </div>
        
        <form method="GET" action="" id="store">
          {{ csrf_field() }}
            <div class="modal-body">             

              <div class="form-group">
                <label class="control-label ">Hora:</label>
                <br>
                <div class="col-md-8">
                  <input type="text" name="time" id="time" value="{{ old('time') }}" class="form-control time_element"/>
                </div>
              </div>
              <br>              
            </div>  

            <div class="col-md-10">
              @if($errors->any())
                <div class="alert alert-danger">
                  <strong>Campos requeridos</strong>
                </div>
              @endif
            </div>
              
            <div class="modal-footer form-group">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary btn-edit">Guardar</button>
            </div>
          </form>     
      </div>      
    </div>    
  </div>
@stop

@section('table')
	<div class="col-md-12">
		<h3 class="text-info" align="center">Entrada y Salida de Trabajadores</h3>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Empresa</th>
					<th>Entrada</th>
					<th>Salida</th>
				</tr>	
			</thead>
			<tbody>
				@foreach($workers as $worker)
					<tr id="{{ $worker->id }}">
						<td>{{ $worker->name }}</td>
						<td>{{ $worker->company->name }}</td>
						<td>
							@if(($worker->hasEntry('entrada')))
								{{ date("g:i A", strtotime($worker->getEntry('entrada'))) }}
							@else						
								<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModalHours" align="right" data-toggle="tooltip" data-placement="top" title="Agregar" data-container="body" data-id="{{ $worker->id }}" data-operation="1"><span class="glyphicon glyphicon-plus"></span></button>
							@endif
						</td>
						<td>
							@if(($worker->hasEntry('salida')))
								{{ date("g:i A", strtotime($worker->getEntry('salida'))) }}
							@else						
								<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModalHours" align="right" data-toggle="tooltip" data-placement="top" title="Agregar" data-container="body" data-id="{{ $worker->id }}" data-operation="2"><span class="glyphicon glyphicon-plus"></span></button>
							@endif
						</td>
					</tr>						
				@endforeach
			</tbody>
		</table>
	</div>
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
	        $(".time_element").timepicki()

	        $('#myModalHours').on('show.bs.modal', function (event) {
			  	var button = $(event.relatedTarget) // Button that triggered the modal
			  	var worker_id = button.data('id')
			  	var operation = button.data('operation')
			  	console.log(worker_id)
	        	
			  	$('form[id="store"]').attr('action','/entry/worker/' + operation + '/' + worker_id)
			});
	    });
	</script>
@stop