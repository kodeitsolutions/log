<html>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Bienvenido</a>
          <!--img src="http://www.industriascegasa.com/images/cegasa.png" alt="Lights" style="border: 0px; min-height: 87px; line-height: 100%; outline: none; text-decoration: none; width: 150px" height="10"-->
        </div>
        <ul class="nav navbar-nav">
          <li class="dropdown {{ setActive('operation') }}  {{ setActive('category') }} {{ setActive('company') }} {{ setActive('unit') }} {{ setActive('user') }} {{ setActive('operation/add') }}  {{ setActive('category/add') }} {{ setActive('company/add') }} {{ setActive('unit/add') }} {{ setActive('user/add') }} {{ setActive('operation/search') }}  {{ setActive('category/search') }} {{ setActive('company/search') }} {{ setActive('unit/search') }} {{ setActive('user/search') }}">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Maestros <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/operation">Tipo de Movimiento</a></li>
              <li><a href="/category">Categoría</a></li>
              <li><a href="/company">Empresa</a></li>
              <li><a href="/unit">Unidades</a></li>
              <li><a href="/user">Usuarios</a></li>
            </ul>
          </li>
          <li class="{{ setActive('entry')}}"><a href="/entry">Log</a></li>
          <li class="{{ setActive('entry/add')}}"><a href="/entry/add">Agregar Log</a></li>
          <li class="{{ setActive('entry/search')}} {{ setActive('entry/searching')}}"><a href="/entry/search">Buscar registro</a></li>
        </ul>
      </div>
    </nav>       
</html>