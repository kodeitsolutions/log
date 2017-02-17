<html>
	<ul class="nav nav-pills nav-stacked">
	  <li class="{{ setActive('operation') }}"><a href="/operation">Mostrar</a></li>
	  <li class="{{ setActive('operation/add') }}"><a href="/operation/add">Agregar</a></li>
	  <li class="{{ setActive('operation/search') }} {{ setActive('operation/searching') }}"><a href="/operation/search">Buscar</a></li>
	</ul>
</html>