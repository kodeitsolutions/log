@extends('layout')

@section('sidebar')
  @include('materials.sidebar') 
@stop

@section('modal-delete')
  <div id="myModalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Eliminar Tipo de Material</h4>
        </div>
        <div class="modal-body">
          <p>¿Está seguro que desea eliminar el Tipo de Material?</p>
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
          <h4 class="modal-title">Editar tipo de material</h4>
        </div>
        
        <form method="POST" action="" id="edit">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label">Código:</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="code" id="code" value="" autofocus>
                </div>
              </div>
            
              <div class="form-group">
                <label class="control-label">Nombre:</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="name" id="name" value="">
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
    <table class="table table-striped" width="100%">
        <col style="width: 40%">
        <col style="width: 40%">
        <col style="width: 20%">
        <thead>
            <tr>
              <th>Código</th>
              <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
          @foreach($materials as $material)
              <tr id="{{ $material->id }}">
                <td><span id="{{ $material->id }}">{{ $material->code }}</span></td>
                <td><span id="{{ $material->id }}">{{ $material->name }}</span></td>
                <td>{{ $material->description }}</td>
                <td>
                <td align="right" data-toggle="tooltip" data-placement="top" title="Editar" data-container="body"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$material->id}}"><span class="glyphicon glyphicon-pencil"></span></button></td>
                <td align="right" data-toggle="tooltip" data-placement="top" title="Eliminar" data-container="body"><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$material->id}}"><span class="glyphicon glyphicon-trash"></span></button></td>
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
    }); 

    $('#myModalDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var material_id = button.data('id')

        $.get('/material/getMaterial/' + material_id, function(response){
          $('label[id="name"]').text(response.name)
        })
        $('form[id="delete"]').attr('action','material/' + material_id)
    });

    $('#myModalEdit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var material_id = button.data('id')

        $.get('/material/getMaterial/' + material_id, function(response){
          $('input[id="code"]').val(response.code)
          $('input[id="name"]').val(response.name)
        })
        $('form[id="edit"]').attr('action','material/' + material_id)
    });    
  </script>
@stop
  