<html>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Bienvenido</a>
          <!--img src="C:\xampp\htdocs\Intranet\public\images\cegasa.png" alt="Lights" style="width:100%"-->
        </div>
        <ul class="nav navbar-nav">
          <li class="{{ setActive('entry')}}"><a href="/entry">Log</a></li>
          <li class="{{ setActive('entry/add')}}"><a href="entry/add">Agregar registro</a></li>          
        </ul>
      </div>
    </nav>       
</html>
