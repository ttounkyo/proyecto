<?php 
	$db = new mysqli('db608606955.db.1and1.com', 'dbo608606955', '162534Aa', 'db608606955');
		if($db->connect_errno > 0){
		    die('Imposible conectar [' . $db->connect_error . ']');
		}

	$verproductos = 'SELECT * FROM productos JOIN categorias_productos USING (idproducto)
					JOIN categorias USING(idcategoria) GROUP BY idproducto';
	$result_vpro = $db->query($verproductos) or die ($db->connect_error. " en la línea ");
	$products='';
	while ($registro = $result_vpro->fetch_array(MYSQLI_BOTH)){
		$products .='
		<div class="product">
			<div class="title">'.$registro['titulo'].'</div>
			<div class="pic"><img src="../backoffice/'.$registro['ruta'].'" width="128" height="128" alt="'.htmlspecialchars($registro['titulo']).'" /></div>
			<div class="description">'.$registro['descripcion'].'</div>
			<div class="price">'.$registro['precio'].'€</div><br>
			<!--<div class="cantidad">'.$registro['cantidad'].'</div>-->
			<div class="buton"><button class="btn"><a href="indexp.php?sec=pedido&id='.$registro["idproducto"].'">Añadir</a></button></div>
		</div>
		';
		// Class pedir quedarme con el identificador de producto
	}

	$db->close();

?>
		<div id="lista">	
		<?=$products?>	
		</div>