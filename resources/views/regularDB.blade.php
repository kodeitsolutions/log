<html>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">          
        </div>
        <ul class="nav navbar-nav">
          <li class="{{ setActive('entry')}}"><a href="/entry">Log</a></li>
          <li class="{{ setActive('entry/add')}}"><a href="/entry/add">Agregar Log</a></li>
          <li class="{{ setActive('entry/search')}} {{ setActive('entry/searching')}}"><a href="/entry/search">Buscar registro</a></li>          
        </ul>
      </div>
    </nav>       
</html>
