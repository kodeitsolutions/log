<html>
	<ul class="nav nav-pills nav-stacked">
	  <li class="{{ setActive('notification') }}"><a href="/notification">Mostrar</a></li>
	  <li class="{{ setActive('notification/add') }}"><a href="/notification/add">Agregar</a></li>
	  <li class="{{ setActive('notification/search') }} {{ setActive('notification/searching') }}"><a href="/notification/search">Buscar</a></li>
	</ul>
</html>