<?php
require_once "../../funciones.php";

$db = conectarBD();
if ($db->connect_errno > 0) {
	die('Imposible conectar [' . $db->connect_error . ']');
}
?>
<h1>Compras</h1>

<table id="listadopro">
	<tr>
	<th>Identificador</th>
	<th>Metodo pago</th>
	<th>Estado</th>
	<th>Fecha</th>
	<th>Username</th>
<?php
if ($_SESSION['rol'] == 'administrador') {
	// Para agregar el contenido
	?>
	<th>Eliminar</th>
	<th>Modificar</th>
<?php
}
?>
	</tr>

<?php

$verpedido = 'SELECT * FROM pedidos GROUP BY idpedido;';
// JOIN pedidos_has_productos USING (idpedido)
// JOIN producto USING(idproducto)
$result_vpro = $db->query($verpedido) or die($db->connect_error . " en la línea ");
while ($registro = $result_vpro->fetch_array(MYSQLI_BOTH)) {
	$id = $registro['idpedido'];
	$metodop = $registro['idmetodopago'];
	$estado = $registro['estado'];

	echo "<tr>";
	echo "<td>" . $id . "</td>";
	echo "<td>" . $metodop . "</td>";
	echo "<td>" . $estado . "</td>";
	echo "<td>" . $registro['fecha'] . "</td>";
	echo "<td>" . $registro['username'] . "</td>";
	if ($_SESSION['rol'] == 'administrador') {
		echo "<td><a href='index.php?sec=eliminarpe&id=" . $id . "'><button>Eliminar Pedido</button></a></td>";
		echo "<td><a href='index.php?sec=modificarpe&id=" . $id . "&met=" . $metodop . "&est=" . $estado . "'><button>Modificar Pedido</button></a></td>";
	}
	// echo "<td><a href='index.php?sec=pedido&id=".$id."'><button>Seleccionar</button></a></td>";
	echo "</tr>";
}

desconectarBD($db);

?>