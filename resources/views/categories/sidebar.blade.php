<html>
	<ul class="nav nav-pills nav-stacked">
	  <li class="{{ setActive('category') }}"><a href="/category">Mostrar</a></li>
	  <li class="{{ setActive('category/add') }}"><a href="/category/add">Agregar</a></li>
	  <li class="{{ setActive('category/search') }} {{ setActive('category/searching') }}"><a href="/category/search">Buscar</a></li>
	</ul>
</html>