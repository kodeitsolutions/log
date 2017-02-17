<html>
	<ul class="nav nav-pills nav-stacked">
	  <li class="{{ setActive('user') }}"><a href="/user">Mostrar</a></li>
	  <li class="{{ setActive('user/add') }}"><a href="/user/add">Agregar</a></li>
	  <li class="{{ setActive('user/search') }} {{ setActive('user/searching') }}"><a href="/user/search">Buscar</a></li>
</html>