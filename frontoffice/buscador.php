<?php
if(isset($_REQUEST['buscar']) || isset($_REQUEST['id'])){
	$db = new mysqli('mysql.hostinger.es', 'u121308368_boss', '162534Aa', '	u121308368_ttoun');
	
	if (isset($_REQUEST['buscar']) ){
		$busqueda = $_REQUEST['buscar'];
	}elseif(isset($_REQUEST['id'])){
		$busqueda = $_REQUEST['id'];
	}
		// Si hay información para buscar, abrimos la conexión

		$verproductos = "SELECT * FROM productos JOIN categorias_productos USING (idproducto)
				JOIN categorias USING(idcategoria) WHERE titulo='$busqueda' OR marca='$busqueda' OR nombre='$busqueda' GROUP BY idproducto";
		$result_vpro = $db->query($verproductos) or die ($db->connect_error. " en la línea ");
		$products='';
		while ($registro = $result_vpro->fetch_array(MYSQLI_BOTH)){
			$products .='
			<div class="product">
			<div class="title">'.$registro['titulo'].'</div>
			<div class="pic"><img src="../backoffice/'.$registro['ruta'].'" width="128" height="128" alt="'.htmlspecialchars($registro['titulo']).'" /></div>
			<div class="description">'.$registro['descripcion'].'</div>
			<div class="price">'.$registro['precio'].'€</div><br>
			<div class="buton"><button class="btn"><a href="indexp.php?sec=pedido&id='.$registro["idproducto"].'">Añadir</a></button></div>
			</div>
			';
		}
	$db->close();
}
?>

	<h1>Resultados</h1>
	<div id="lista">
	<?=$products?>	
	</div>