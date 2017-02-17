<html>
	<ul class="nav nav-pills nav-stacked">
	  <li class="{{ setActive('company') }}"><a href="/company">Mostrar</a></li>
	  <li class="{{ setActive('company/add') }}"><a href="/company/add">Agregar</a></li>
	  <li class="{{ setActive('company/search') }} {{ setActive('company/searching') }}"><a href="/company/search">Buscar</a></li>
	</ul>
</html>