@extends('layout')

@section('sidebar')
  @include('operations.sidebar') 
@stop

@section('modal-delete')
  <div id="myModalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Eliminar movimiento</h4>
        </div>
        <div class="modal-body">
          <p>¿Está seguro que desea eliminar el movimiento?</p>
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
              <h4 class="modal-title">Editar movimiento</h4>
        </div>
        
        <form method="POST" action="" id="edit">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}
            <div class="modal-body form-group">
              <label class="control-label">Nombre:</label>
                <div class="form-group">
                  <textarea name="name" id="name" class="form-control" autofocus></textarea>
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
              <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
          @foreach($operations as $operation)
              <tr id="operation{{ $operation->id }}">
                <td><span id="{{ $operation->id }}">{{ $operation->name }}</span></td>              
                <td align="right"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$operation->id}}"><span class="glyphicon glyphicon-pencil"></span></button>
                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$operation->id}}"><span class="glyphicon glyphicon-trash"></span></button>
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
        var operation_id = button.data('id')

        $.get('/operation/getOperation/' + operation_id, function(response){
        $('label[id="name"]').text(response.name)
        })
        $('form[id="delete"]').attr('action','operation/' + operation_id)
    });

    $('#myModalEdit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var operation_id = button.data('id')

        $.get('/operation/getOperation/' + operation_id, function(response){
          $('textarea[id="name"]').text(response.name)
        })
        $('form[id="edit"]').attr('action','operation/' + operation_id)
    });    
  </script>
@stop
  