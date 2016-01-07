<?php
if(isset($_POST['buscar'])){
	$db = new mysqli('localhost', 'root', '', 'ttounkyo');
	
	$busqueda = $_POST['buscar'];
	if (empty($busqueda)){
		$texto = 'Búsqueda sin resultados';
	} 
	else{
		// Si hay información para buscar, abrimos la conexión

		$verproductos = "SELECT * FROM productos JOIN categorias_productos USING (idproducto)
				JOIN categorias USING(idcategoria) WHERE titulo='$busqueda' OR marca='$busqueda' OR nombre='$busqueda' ";
		$result_vpro = $db->query($verproductos) or die ($db->connect_error. " en la línea ");
		$products='';
		while ($registro = $result_vpro->fetch_array(MYSQLI_BOTH)){
			$products .='
			<div class="product">
			<div class="pic"><img src="../backoffice/'.$registro['ruta'].'" width="128" height="128" alt="'.htmlspecialchars($registro['titulo']).'" /></div>
			<div class="title">'.$registro['titulo'].'</div>
			<div class="price">€'.$registro['precio'].'</div>
			<div class="description">'.$registro['descripcion'].'</div>
			<div class="link">'.$registro['cantidad'].'</div>
			<div class="clear"></div>
			<div class="pedir">Pedir</div>
			</div>
			';
		}

	} 

	$db->close();
} 
?>

	<h1>Resultados</h1>
	<div id="lista">
	<?=$products?>	
	</div>