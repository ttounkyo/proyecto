<?php
require_once "../funciones.php";

$db = conectarBD();
if ($db->connect_errno > 0) {
	die('Imposible conectar [' . $db->connect_error . ']');
}

$verproductos = 'SELECT * FROM productos JOIN categorias_productos USING (idproducto)
					JOIN categorias USING(idcategoria) GROUP BY idproducto';
$result_vpro = $db->query($verproductos) or die($db->connect_error . " en la línea ");
$products = '';
while ($registro = $result_vpro->fetch_array(MYSQLI_BOTH)) {

	$products .= '
					<div class="product">
						<div class="title">' . $registro['titulo'] . '</div>
						<div class="pic"><img src="../backoffice/' . str_replace("../", "", $registro['ruta']) . '" width="128" height="128" alt="' . htmlspecialchars($registro['titulo']) . '" /></div>
						<div class="description">' . $registro['descripcion'] . '</div>
						<div class="price">' . $registro['precio'] . '€</div><br>
						<!--<div class="cantidad">' . $registro['cantidad'] . '</div>-->
						<div class="buton"><a href="index.php?sec=pedido&id=' . $registro["idproducto"] . '"><button class="btn">Añadir</button></a></div>
					</div>
					';
	// Class pedir quedarme con el identificador de producto
}

desconectarBD($db);

?>
		<div id="lista">
		<?=$products?>
		</div>