 <?php
require_once "../funciones.php";

$db = conectarBD();
if ((empty($_SESSION['usuariofront']) || empty($_SESSION['usuario']) || !empty($_SESSION['usuariofront']) || !empty($_SESSION['usuario'])) && !empty($_REQUEST['id'])) {

	?>

<form action="index.php?sec=compra&id=<?php echo $_REQUEST['id'] ?>" method="POST">
 	<div>
 		<label for="">Metodo de pago.</label>
 		<br>
 		<select name="pago">
		  <option value="paypal">PayPal</option>
		  <option value="mastercard">MasterCard</option>
		  <option value="visa" selected>Visa</option>
		</select>
 	</div>
 	<br>
 	<div>
 		<label for="">Estado</label>
 		<br>
 		<input type="text" name="estado" value="Pedido">
 	</div>


<table id="listadopro">
	<tr>
	<th>Imagen</th>
	<th>Titulo</th>
	<th>Descripcion</th>
	<th>Precio</th>
	<th>Marca</th>
	<th>Cantidad</th>
	</tr>

<?php
if (isset($_REQUEST['id'])) {
		$cantidad = $_POST['cantidad'];
		$id = $_REQUEST['id'];

		$verproductos = "SELECT * FROM productos WHERE idproducto='$id'";
		$resultado = mysqli_query($db, $verproductos);

		while ($registro = mysqli_fetch_array($resultado)) {
			$productoscarrito = array("titulo" => $registro['titulo'], "precio" => $registro['precio'], "descripcion" => $registro['descripcion'], "cantidad" => $cantidad, "ruta" => $registro['ruta'], "marca" => $registro['marca']);
			$_SESSION['carrito'][] = $productoscarrito;
			// $_SESSION['pedido'][] = $products;
			$_SESSION['id'][] = $registro['idproducto'];
			$_SESSION['can'][] = $cantidad;
		}
	}
	desconectarBD($db);
	?>
<?php
// if(isset($_SESSION['pedido'])){
	// 	for($i=0;$i<count($_SESSION['pedido']);$i++){
	// 		echo $_SESSION['pedido'][$i];
	// 	}
	// }

	if (isset($_SESSION['carrito'])) {
		foreach ($_SESSION['carrito'] as $key => $value) {
			echo '<tr>
			<td><img id="imagen" src="../backoffice/' . str_replace("../", "", $value['ruta']) . '" alt="imagen"></img></td>
			<td class="textupper">' . $value['titulo'] . '</td>
			<td class="textupper">' . $value['descripcion'] . '</td>
			<td class="textupper">' . $value['precio'] . '</td>
			<td class="textupper">' . $value['marca'] . '</td>
			<td>' . $value['cantidad'] . '</td>
			</tr>
		';
		}
	}

	?>
 </table>
 	<button class="btn"><a href="index.php?sec=patines">Seguir pidiendo</a></button>
 	<button class="btn"><a href="index.php?sec=cancelar">Cancelar Pedido</a></button>
 	<button class="btn"><a href="index.php?sec=guardar">Guardar</a></button>
	<?php
if (!empty($_SESSION['usuariofront']) || !empty($_SESSION['usuario'])) {
		?>
			<button class="btn" type="submit">Comprar</button>
			<?php
} else {
		?>
			<span onclick="showmenu()" class="btn">Tiene que iniciar session para comprar :)</span>
			<?php
}
	?>


</form>

<?php
} else if (empty($_REQUEST['id'])) {
	echo "<h1>No hay nada en el carrito :)";
}

?>