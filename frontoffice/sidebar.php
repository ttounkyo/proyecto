<aside class="buscador">
	
<div class="busc">
	<h1>BUSCADOR</h1>
	<form id="buscador" name="buscador" method="post" action="indexp.php?sec=buscador">
		<input id="buscar" name="buscar" type="search" placeholder="Buscar aquí..." autofocus >
		<input type="submit" name="buscador" class="btn" value="buscar">
	</form>
	<br>
	<h1>CATEGORIAS</h1>
</div >
	
	<?php
		$db = new mysqli('db608606955.db.1and1.com', 'dbo608606955', '162534Aa', 'db608606955');
	    $query = 'SELECT * FROM categorias;';
	    $resultado = $db->query($query) or die ($db->connect_error. " en la línea ");
	    $db->close();
	?>

	    <ul class="lista">
			<?php
				while($row = $resultado->fetch_array(MYSQLI_BOTH)){
					echo "<li><a href=\"indexp.php?sec=buscador&id=".$row['nombre']."\">".$row['nombre']."</a></li>";
				}
			?>
			<li><a href="indexp.php?sec=patines">home</a></li>
	    </ul>

	    <?php
	if (isset($_SESSION["catg"])){
		mysqli_free_result($result);
		mysqli_close($db);
	}
	?>		
</aside>
