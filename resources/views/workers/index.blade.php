@extends('layout')

@section('sidebar')
  @include('workers.sidebar') 
@stop

@section('modal-delete')
  <div id="myModalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Eliminar Trabajador</h4>
        </div>
        <div class="modal-body">
          <p>¿Está seguro que desea eliminar al Trabajador?</p>
          <label id="name">Descripción</label>
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
                <label class="control-label">Nombre:</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="name" id="name" value="" autofocus>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label">Cédula:</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="worker_id" id="worker_id" value="">
                </div>
              </div>

              <div class="form-group form-check form-check-inline">
                <label class="control-label">Empresa:</label>
                <select class="form-control input-sm" id="companie_id" name="companie_id">
                  @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                   @endforeach
                </select>                 
              </div>

              <div class="form-group">
                <label class="control-label">Departamento:</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="department" id="department" value="">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label">Cargo:</label>
                <div class="form-group">
                  <input type="text" class="form-control" name="position" id="position" value="">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label">Estatus:</label>
                <select class="form-control input-sm" id="status" name="status">
                  <option value="A">ACTIVO</option>
                  <option value="I">INACTIVO</option>
                </select>
              </div>            
              
              <div class="modal-footer form-group">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary btn-edit">Guardar</button>
              </div>

            </div>
          </form>     
      </div>      
    </div>    
  </div>
@stop

@section('modal-filter')
  <div id="myModalCompany" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="email">Filtrar por empresa</h4>
        </div>

        <form method="GET" action="/worker/searching" id="email">              
          {{ csrf_field() }}
          <div class="modal-body form-group">
            <div class="form-group form-check form-check-inline">
              <input type="hidden" class="form-control" name="search" id="search" value="companie_id">
              <label class="control-label">Empresa:</label>
              <select class="form-control input-sm" id="value" name="value">
                @foreach($companies as $company)
                  <option value="{{ $company->id }}">{{ $company->name }}</option>
                 @endforeach
              </select>                 
            </div>
          </div>
          <div class="modal-footer form-group">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary btn-edit">Aceptar</button>
          </div>
        </form>     
      </div>      
    </div>    
  </div>
@stop

@section('content')  
  <h4 class="text-info" align="center">TRABAJADORES</h4>
  <div class="col-md-10">
    @if($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif
  </div> 
  <div class="form-group col-md-12" align="right">         
    <button class="btn btn-basic btn-xs" data-toggle="tooltip" data-placement="top" title="Filtar empresa" data-container="body"><span class="glyphicon glyphicon-filter" data-toggle="modal" data-target="#myModalCompany">
  </div>
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Cédula</th>
            <th>Empresa</th>
            <th>Departamento</th>
            <th>Cargo</th>
            <th>Estatus</th>
            <th colspan="2" class="text-center">Operación</th>
          </tr>
        </thead>
        <tbody>
          @foreach($workers as $worker)
            <tr id="{{ $worker->id }}">
              <td>{{ $worker->name }}</td>
              <td>{{ $worker->worker_id }}</td>
              <td>{{ $worker->company->name }}</td>
              <td>{{ $worker->department }}</td>
              <td>{{ $worker->position }}</td>
              <td>{{ ($worker->status == 'A') ? 'ACTIVO' : 'INACTIVO' }}</td>
              <td align="right"><span data-toggle="tooltip" data-placement="top" title="Editar" data-container="body"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$worker->id}}"><span class="glyphicon glyphicon-pencil"></span></button></span></td>
              <td align="left"><span data-toggle="tooltip" data-placement="top" title="Eliminar" data-container="body"><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$worker->id}}"><span class="glyphicon glyphicon-trash"></span></button></span></td>
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
      var worker_id = button.data('id');

      modalDelete("worker", worker_id);
    });

    $('#myModalEdit').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var worker_id = button.data('id');     

      modalEdit("worker",worker_id);
    });    
  </script>
@stop

  