<html>
	<ul class="nav nav-pills nav-stacked">
	  <li class="{{ setActive('worker') }}"><a href="/worker">Mostrar</a></li>
	  <li class="{{ setActive('worker/add') }}"><a href="/worker/add">Agregar</a></li>
	  <li class="{{ setActive('worker/search') }} {{ setActive('worker/searching') }}"><a href="/worker/search">Buscar</a></li>
	  <li class="{{ setActive('worker/upload') }}"><a href="/worker/upload">Importar</a></li>
	</ul>
</html>