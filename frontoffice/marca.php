<?php 
		require_once("../funciones.php");
		$db = conectarBD();
			if($db->connect_errno > 0){
			    die('Imposible conectar [' . $db->connect_error . ']');
			}

		$verproductos = 'SELECT marca,COUNT(marca) AS Cantidad FROM productos GROUP BY marca';
		$result_vpro = $db->query($verproductos) or die ($db->connect_error. " en la línea ");
		$products='';
		while ($registro = $result_vpro->fetch_array(MYSQLI_BOTH)){
			$products .='
			<div class="products">
			<div class="title">'.$registro['marca'].'</div>
			<div class="num">'.$registro['Cantidad'].'</div>
			</div>
			';
			// Class pedir quedarme con el identificador de producto
		}

		desconectarBD($db);

?>
		<div id="lista">	
		<?=$products?>	
		</div>