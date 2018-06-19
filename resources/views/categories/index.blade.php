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
  <h4 class="text-info" align="center">CATEGORÍAS</h4>
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
            <th>Nombre</th>
            <th>Descripción</th>
            <th class="text-center">Persona</th>
            <th class="text-center">Material</th>
            <th class="text-center">Vehículo</th>
            <th class="text-center">Combinado</th>
            <th colspan="2" class="text-center"> Operación</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
            <tr id="category{{ $category->id }}">
              <td><span id="{{ $category->id }}">{{ $category->name }}</span></td>
              <td>{{ $category->description }}</td>
              <td align="center"><input type="checkbox" disabled {{ ($category->person == 1) ? 'checked' : 'unchecked' }}></td>
              <td align="center"><input type="checkbox" disabled {{ ($category->material == 1) ? 'checked' : 'unchecked' }}></td>
              <td align="center"><input type="checkbox" disabled {{ ($category->vehicle == 1) ? 'checked' : 'unchecked' }}></td>
              <td align="center"><input type="checkbox" disabled {{ ($category->combined == 1) ? 'checked' : 'unchecked' }}></td>            
              <td align="right"><span data-toggle="tooltip" data-placement="top" title="Editar" data-container="body"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$category->id}}"><span class="glyphicon glyphicon-pencil"></span></button></span></td>
              <td align="left"><span data-toggle="tooltip" data-placement="top" title="Eliminar" data-container="body"><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$category->id}}"><span class="glyphicon glyphicon-trash"></span></button></span></td>               
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
        var button = $(event.relatedTarget) // BOTÓN QUE EJECUTÓ EL MODAL
        var category_id = button.data('id')

        modalDelete("category", category_id);
    });

    $('#myModalEdit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var category_id = button.data('id');

        modalEdit("category",category_id);
    });       
  </script>
@stop
  