<html>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
        </div>
        <ul class="nav navbar-nav">
          <li class="dropdown {{ setActive('operation') }}  {{ setActive('category') }} {{ setActive('company') }} {{ setActive('unit') }} {{ setActive('user') }} {{ setActive('material') }} {{ setActive('operation/add') }}  {{ setActive('category/add') }} {{ setActive('company/add') }} {{ setActive('unit/add') }} {{ setActive('user/add') }} {{ setActive('material/add') }} {{ setActive('operation/search') }}  {{ setActive('category/search') }} {{ setActive('company/search') }} {{ setActive('unit/search') }} {{ setActive('user/search') }} {{ setActive('material/search') }}">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Maestros <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/operation">Tipo de Movimiento</a></li>
              <li><a href="/category">Categoría</a></li>
              <li><a href="/company">Empresa</a></li>
              <li><a href="/unit">Unidades</a></li>
              <li><a href="/material">Tipo de Material</a></li>
              <li><a href="/material">Usuarios</a></li>
            </ul>
          </li>
          <li class="dropdown {{ setActive('entry')}} {{ setActive('entry/add')}} {{ setActive('entry/search')}} {{ setActive('entry/searching')}}">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Log <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/entry">Ver</a></li>
              <li><a href="/entry/add">Agregar Log</a></li>
              <li ><a href="/entry/search">Buscar registro</a></li>
            </ul>
          </li>          
        </ul>
      </div>
    </nav>       
</html>