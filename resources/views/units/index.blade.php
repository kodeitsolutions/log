@extends('layout')

@section('sidebar')
  @include('units.sidebar') 
@stop

@section('modal-delete')
  <div id="myModalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Eliminar unidad</h4>
        </div>
        <div class="modal-body">
          <p>¿Está seguro que desea eliminar la unidad?</p>
          <label id="name">Nombre</label>
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
          <h4 class="modal-title">Editar unidad</h4>
        </div>
        
        <form method="POST" action="" id="edit">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label">Código:</label>
                <div class="form-group">
                  <textarea name="code" id="code" class="form-control"></textarea>
                </div>
              </div>
            
              <div class="form-group">
                <label class="control-label">Nombre:</label>
                <div class="form-group">
                  <textarea name="name" id="name" class="form-control" autofocus></textarea>
                </div>
              </div>
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
    <table class="table table-striped">
        <thead>
            <tr>
              <th>Código</th>
              <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
          @foreach($units as $unit)
              <tr id="unit{{ $unit->id }}">
                <td><span id="{{ $unit->id }}">{{ $unit->code }}</span></td>
                <td><span id="{{ $unit->id }}">{{ $unit->name }}</span></td>
                <td>{{ $unit->description }}</td>              
                <td align="right"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$unit->id}}"><span class="glyphicon glyphicon-pencil"></span></button>
                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$unit->id}}"><span class="glyphicon glyphicon-trash"></span></button>
                </td>   
            </tr>
          @endforeach      
        </tbody>
     </table>    
  </div>   
@stop

@section('script')
  <script type="text/javascript">   
    $('#myModalDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var unit_id = button.data('id')

        $.get('/unit/getUnit/' + unit_id, function(response){
        $('label[id="name"]').text(response.name)
        })
        $('form[id="delete"]').attr('action','unit/' + unit_id)
    });

    $('#myModalEdit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var unit_id = button.data('id')

        $.get('/unit/getUnit/' + unit_id, function(response){
          $('textarea[id="code"]').text(response.code)
          $('textarea[id="name"]').text(response.name)
        })
        $('form[id="edit"]').attr('action','unit/' + unit_id)
    });    
  </script>
@stop
  