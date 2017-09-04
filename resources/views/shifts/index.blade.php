@extends('layout')

@section('sidebar')
  @include('shifts.sidebar') 
@stop


@section('modal-delete')
  <div id="myModalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Eliminar Turno</h4>
        </div>
        <div class="modal-body">
          <p>¿Está seguro que desea eliminar el Turno?</p>
          <label id="description">Descripción</label>
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

@section('modal-edit')
  <div id="myModalEdit" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar turno</h4>
        </div>
        
        <form method="POST" action="" id="edit">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label">Descripción:</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="description" id="description" value="" autofocus>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label ">Hora Comienzo:</label>
                <br>
                <div class="col-md-8">
                  <input type="text" name="start" id="start" value="{{ old('start') }}" class="form-control time_element"/>
                </div>
              </div>
              <br>
              <div class="form-group">
                <label class="control-label">Hora Fin:</label>
                <br>
                <div class="col-md-8">            
                  <input type="text" name="end" id="end" value="{{ old('end') }}" class="form-control time_element"/>
                </div>
              </div> 
              <br>
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

@section('content')  
  <div class="col-md-11">
    <h4 class="text-info" align="center">TURNOS</h4>
    <table class="table table-striped" width="100%">
        <col style="width: 40%">
        <col style="width: 40%">
        <col style="width: 20%">
        <thead>
            <tr>
              <th>Descripción</th>
              <th>Comienzo</th>
              <th>Fin</th>
            </tr>
        </thead>
        <tbody>
          @foreach($shifts as $shift)
              <tr id="{{ $shift->id }}">
                <td>{{ $shift->description }}</td>
                <td>{{ date("g:i A", strtotime($shift->start)) }}</td>
                <td>{{ date("g:i A", strtotime($shift->end)) }}</td>
                <td>
                <td align="right" data-toggle="tooltip" data-placement="top" title="Editar" data-container="body"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$shift->id}}"><span class="glyphicon glyphicon-pencil"></span></button></td>
                <td align="right" data-toggle="tooltip" data-placement="top" title="Eliminar" data-container="body"><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$shift->id}}"><span class="glyphicon glyphicon-trash"></span></button></td>
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
        $('[data-toggle="tooltip"]').tooltip(); 
        $(".time_element").timepicki()
    }); 

    $('#myModalDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var shift_id = button.data('id')

        $.get('/shift/getShift/' + shift_id, function(response){
          $('label[id="description"]').text(response.description)
        })
        $('form[id="delete"]').attr('action','shift/' + shift_id)
    });

    $('#myModalEdit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var shift_id = button.data('id')

        function formatTime(time){
          var shift_time = time.substring(0,5)

          if(shift_time.substring(0,2) < 12) {
            shift_time += ' AM';
          }
          else {
            shift_time = ((shift_time.substring(0,2) - 12) < 10) ? shift_time = '0'+(shift_time.substring(0,2) - 12) + shift_time.substring(2,5) + ' PM' : shift_time = (shift_time.substring(0,2) - 12) + shift_time.substring(2,5) + ' PM';
          }
          return shift_time
        }

        $.get('/shift/getShift/' + shift_id, function(response){
          console.log(response)
          $('input[id="description"]').val(response.description) 
          $('input[id="start"]').val(formatTime(response.start))
          $('input[id="end"]').val(formatTime(response.end))
        })
        $('form[id="edit"]').attr('action','shift/' + shift_id)
    });    
  </script>
@stop

  