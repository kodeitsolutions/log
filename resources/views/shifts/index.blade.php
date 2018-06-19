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
  <h4 class="text-info" align="center">TURNOS</h4>     
  <div class="col-md-10">
    @if($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif
  </div> 
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-striped">
          <thead>
              <tr>
                <th>Descripción</th>
                <th>Comienzo</th>
                <th>Fin</th>
                <th colspan="2" class="text-center">Operación</th>
              </tr>
          </thead>
          <tbody>
            @foreach($shifts as $shift)
              <tr id="{{ $shift->id }}">
                <td>{{ $shift->description }}</td>
                <td>{{ $shift->timeView($shift->start) }}</td>
                <td>{{ $shift->timeView($shift->end) }}</td>
                <td align="right"><span data-toggle="tooltip" data-placement="top" title="Editar" data-container="body"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$shift->id}}"><span class="glyphicon glyphicon-pencil"></span></button></span></td>
                <td align="left"><span data-toggle="tooltip" data-placement="top" title="Eliminar" data-container="body"><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$shift->id}}"><span class="glyphicon glyphicon-trash"></span></button></span></td>
              </tr>
            @endforeach      
          </tbody>
      </table>
    </div> 
  </div>   
@stop

@section('script')
  <script>      

    $('#myModalDelete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var shift_id = button.data('id');

      modalDelete("shift", shift_id);
    });

    $('#myModalEdit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var shift_id = button.data('id');

      modalEdit("shift",shift_id);
    });    
  </script>
@stop

  