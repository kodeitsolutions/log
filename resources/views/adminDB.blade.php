<html>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Bienvenido</a>
          <!--img src="C:\xampp\htdocs\Intranet\public\images\cegasa.png" alt="Lights" style="width:100%"-->
        </div>
        <ul class="nav navbar-nav">
          <li class="dropdown {{ setActive('operation') }}  {{ setActive('category') }} {{ setActive('company') }} {{ setActive('unit') }} {{ setActive('operation/add') }}  {{ setActive('category/add') }} {{ setActive('company/add') }} {{ setActive('unit/add') }} {{ setActive('operation/search') }}  {{ setActive('category/search') }} {{ setActive('company/search') }} {{ setActive('unit/search') }}">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Maestros <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/operation">Tipo de Movimiento</a></li>
              <li><a href="/category">Categoría</a></li>
              <li><a href="/company">Empresa Destino</a></li>
              <li><a href="/unit">Unidades</a></li>
            </ul>
          </li>
          <li class="{{ setActive('entry')}}"><a href="/entry">Log</a></li>
          <li class="{{ setActive('entry/add')}}"><a href="/entry/add">Agregar registro</a></li>
          <li class="{{ setActive('user')}} {{ setActive('user/add') }} {{ setActive('user/search') }} {{ setActive('user/searching') }}"><a href="/user">Usuarios</a></li>
        </ul>
      </div>
    </nav>       
</html>
