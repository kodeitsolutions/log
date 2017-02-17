<html>
	<ul class="nav nav-pills nav-stacked">
	  <li class="{{ setActive('entry') }}"><a href="/entry">Mostrar</a></li>
	  <li class="{{ setActive('entry/add') }}"><a href="/entry/add">Agregar</a></li>
	  <li class="{{ setActive('entry/search') }} {{ setActive('entry/searching') }}"><a href="/entry/search">Buscar</a></li>
	</ul>
</html>