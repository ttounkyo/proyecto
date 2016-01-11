
<aside class="buscador2">
	
<div class="busc">
	<h1>BUSCADOR</h1>
	<form id="buscador" name="buscador" method="post" action="index.php?sec=buscador">
		<input id="buscar" name="buscar" type="search" placeholder="Buscar aquí..." autofocus >
		<input type="submit" name="buscador" class="btn" value="buscar">
	</form>
	<br>
	<h1>CATEGORIAS</h1>
</div >
	
	<?php
		require_once("../funciones.php");
		$db = conectarBD();
	    $query = 'SELECT * FROM categorias;';
	        // Comprobar la query
	    $resultado = $db->query($query) or die ($db->connect_error. " en la línea ");
	    //$categoria = $resultado->fetch_array(MYSQLI_BOTH);
	//    $ruta      = $resultado->fetch_array(MYSQLI_BOTH)['ruta'];
	    desconectarBD($db);
	?>

	    <ul class="lista">
			<?php
				while($row = $resultado->fetch_array(MYSQLI_BOTH)){
					echo "<li><a href=\"index.php?sec=buscador&id=".$row['nombre']."\">".$row['nombre']."</a></li>";
				}
			?>
			<li><a href="index.php?sec=patines">home</a></li>
	    </ul>

	    <?php
	if (isset($_SESSION["catg"])){
		mysqli_free_result($result);
		mysqli_close($db);
	}
	?>		
</aside>