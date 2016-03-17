<?php
require_once "../funciones.php";

$db = conectarBD();
if (empty($_SESSION['usuariofront']) || empty($_SESSION['usuario'])) {
	if (isset($_REQUEST['error'])) {
		echo "Ha habido un error en la compra por favor vuelva a intentarlo";
	}
	?>

	<h1>Realizar pedido!</h1>
 	<!-- <div>
 		<label for="">Metodo de pago.</label>
 		<br> <select name="pago">
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
 	</div> -->


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
			$productoscarrito = array("id" => $registro['idproducto'], "titulo" => $registro['titulo'], "precio" => $registro['precio'], "descripcion" => $registro['descripcion'], "cantidad" => $cantidad, "ruta" => str_replace("../", "", $registro['ruta']), "marca" => $registro['marca']);
			$_SESSION['carrito'][] = $productoscarrito;
		}
	}
	desconectarBD($db);

// if(isset($_SESSION['pedido'])){
	// 	for($i=0;$i<count($_SESSION['pedido']);$i++){
	// 		echo $_SESSION['pedido'][$i];
	// 	}
	// }
	$cantidad = 0;
	if (isset($_SESSION['carrito'])) {

		foreach ($_SESSION['carrito'] as $key => $value) {
			echo '<tr>
			<td><img id="imagen" src="../backoffice/' . $value['ruta'] . '" alt="imagen"></td>
			<td class="textupper">' . $value['titulo'] . '</td>
			<td class="textupper">' . $value['descripcion'] . '</td>
			<td class="textupper">' . $value['precio'] . '</td>
			<td class="textupper">' . $value['marca'] . '</td>
			<td>' . $value['cantidad'] . '</td>
			</tr>
		';
			$cantidad += ($value['precio'] * $value['cantidad']);
		}
	}

	?>
 </table>
 	<button class="btn"><a href="index.php?sec=patines">Seguir pidiendo</a></button>
 	<button class="btn"><a href="index.php?sec=cancelar">Cancelar Pedido</a></button>
 	<button class="btn"><a href="compra_pdf.php">Guardar HTML</a></button>
<?php
if (!empty($_SESSION['usuariofront']) || !empty($_SESSION['usuario'])) {

		// Se incluye la librería
		include './api_php/redsys/apiRedsys.php';
// Se crea Objeto
		$miObj = new RedsysAPI;

// Valores de entrada
		$fuc = "TTOUNKYO";
		$terminal = "871";
		$moneda = "978";
		$trans = "0";
		$url = "http://ttounkyo-ttounkyo.rhcloud.com/frontoffice/";
		$urlOKKO = "http://ttounkyo-ttounkyo.rhcloud.com/frontoffice/api_php/redsys/recepcionpedido.php";
		$id = time(); // id pedido time()
		$amount = $cantidad . "00"; // Cantidad

// Se Rellenan los campos
		$miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
		$miObj->setParameter("DS_MERCHANT_ORDER", strval($id));
		$miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $fuc);
		$miObj->setParameter("DS_MERCHANT_CURRENCY", $moneda);
		$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $trans);
		$miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
		$miObj->setParameter("DS_MERCHANT_MERCHANTURL", $url);
		$miObj->setParameter("DS_MERCHANT_URLOK", $urlOKKO);
		$miObj->setParameter("DS_MERCHANT_URLKO", $urlOKKO);

//Datos de configuración
		$version = "HMAC_SHA256_V1";
		$kc = 'Mk9m98IfEblmPfrpsawt7BmxObt98Jev'; //Clave recuperada de CANALES
		// Se generan los parámetros de la petición
		$request = "";
		$params = $miObj->createMerchantParameters();
		$signature = $miObj->createMerchantSignature($kc);

		?>

<form name="frm" action="http://jguasch.esy.es/redsys/lacaixa.php" method="POST">
<input type="hidden" name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
 <input type="hidden" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
<input type="hidden" name="Ds_Signature" value="<?php echo $signature; ?>"/></br>
<button class="btn" type="submit">Comprar PDF/PP</button>
<!-- <a href='./factura/compra.php'> -->



<?php
} else {
		?>
		<span onclick="showmenu()" class="btn">Tiene que iniciar session para comprar :)</span>
<?php
}
	?>
	</form>

<?php
} else if (empty($_REQUEST['id']) && empty($_SESSION['carrito'])) {
	echo "<h1>No hay nada en el carrito :)</h1>";
}

?>