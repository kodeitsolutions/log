@extends('layout')

@section('sidebar')
  @include('categories.sidebar') 
@stop

@section('modal-delete')
  <div id="myModalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Eliminar categoría</h4>
        </div>
        <div class="modal-body">
          <p>¿Está seguro que desea eliminar la categoría?</p>
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
              <h4 class="modal-title">Editar categoría</h4>
        </div>
        
        <form method="POST" action="" id="edit">
          {{ method_field('PATCH') }}
          {{ csrf_field() }}
            <div class="modal-body form-group">              
              <div class="form-group">
                <label class="control-label">Nombre:</label>
                <input type="text" class="form-control" name="name" id="name" value="" autofocus>
              </div>

              <div class="form-group">
                <label class="control-label">Descripción:</label>
                <textarea name="description" id="description" class="form-control"></textarea>
              </div>

              <div class=" form-group checkbox">
                <label class="control-label"><input type="checkbox" name="person" id="person">Persona</label>
              </div>

              <div class=" form-group checkbox">
                <label class="control-label"><input type="checkbox" name="material" id="material">Material</label>
              </div>

              <div class=" form-group checkbox">
                <label class="control-label"><input type="checkbox" name="vehicle" id="vehicle">Vehículo</label>
              </div>

              <div class=" form-group checkbox">
                <label class="control-label"><input type="checkbox" name="combined" id="combined">Combinado</label>
              </div>
            </div>            

            <div class="modal-footer form-group">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary btn-edit" id="saveButton">Guardar</button>
            </div>
          </form>     
      </div>      
    </div>    
  </div>
@stop

@section('content')
  <div class="col-md-11">
    <table class="table table-striped" width="100%" id="index">
      <col style="width: 40%">
      <col style="width: 40%">
      <col style="width: 20%">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Descripción</th>
          <th style="text-align:center">Persona</th>
          <th style="text-align:center">Material</th>
          <th style="text-align:center">Vehículo</th>
          <th style="text-align:center">Combinado</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
          <tr id="category{{ $category->id }}">
            <td><span id="{{ $category->id }}">{{ $category->name }}</span></td>
            <td>{{ $category->description }}</td>
            <td style="text-align:center"><input type="checkbox" disabled {{ ($category->person == 1) ? 'checked' : 'unchecked' }}></td>
            <td style="text-align:center"><input type="checkbox" disabled {{ ($category->material == 1) ? 'checked' : 'unchecked' }}></td>
            <td style="text-align:center"><input type="checkbox" disabled {{ ($category->vehicle == 1) ? 'checked' : 'unchecked' }}></td>
            <td style="text-align:center"><input type="checkbox" disabled {{ ($category->combined == 1) ? 'checked' : 'unchecked' }}></td>
            <td>
            <td align="right" data-toggle="tooltip" data-placement="top" title="Editar" data-container="body"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$category->id}}"><span class="glyphicon glyphicon-pencil"></span></button></td>
            <td data-toggle="tooltip" data-placement="top" title="Eliminar" data-container="body">
            <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$category->id}}"><span class="glyphicon glyphicon-trash"></span></button></td>   </td>
          </tr>
        @endforeach      
      </tbody>
     </table>    
  </div>   
@stop

@section('script')
  <script type="text/javascript">   
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip() 
    });

    $('#myModalDelete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var category_id = button.data('id')

        $.get('/category/getCategory/' + category_id, function(response){
        $('label[id="name"]').text(response.name)
        })
        $('form[id="delete"]').attr('action','category/' + category_id)
    });

    $('#myModalEdit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var category_id = button.data('id')

        $.get('/category/getCategory/' + category_id, function(response){
          $('input[id="name"]').val(response.name)
          $('textarea[id="description"]').text(response.description)

          if (response.person == 1){
            $('input[id="person"]').prop('checked', true)
          }
          else{
            $('input[id="person"]').prop('checked', false)
          }
          if (response.material == 1){
            $('input[id="material"]').prop('checked', true)
          }
          else{
            $('input[id="material"]').prop('checked', false)
          }
          if (response.vehicle == 1){
            $('input[id="vehicle"]').prop('checked', true)
          }
          else{
            $('input[id="vehicle"]').prop('checked', false)
          }
          if (response.combined == 1){
            $('input[id="combined"]').prop('checked', true)
          }
          else{
            $('input[id="combined"]').prop('checked', false)
          }          
        })
        $('form[id="edit"]').attr('action','category/' + category_id)
    });  

     
  </script>
@stop
  