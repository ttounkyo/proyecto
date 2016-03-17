<html>
<body>
<?php
session_start();
require_once "../../../funciones.php";
require_once '../../../backoffice/PHPMailer-master/class.phpmailer.php';
require_once '../../../backoffice/PHPMailer-master/PHPMailerAutoload.php';
require_once "../../../html2pdf/vendor/autoload.php";

include 'apiRedsys.php';

// Se crea Objeto
$miObj = new RedsysAPI;

if (!empty($_POST)) {
//URL DE RESP. ONLINE

	$version = $_POST["Ds_SignatureVersion"];
	$datos = $_POST["Ds_MerchantParameters"];
	$signatureRecibida = $_POST["Ds_Signature"];

	$decodec = $miObj->decodeMerchantParameters($datos);
	$kc = 'Mk9m98IfEblmPfrpsawt7BmxObt98Jev'; //Clave recuperada de CANALES
	$firma = $miObj->createMerchantSignatureNotif($kc, $datos);

	if ($firma === $signatureRecibida) {
		echo "FIRMA OK";
		if (!empty($_SESSION['usuariofront']) || !empty($_SESSION['usuario'])) {
			$db = conectarBD();
			if ($db->connect_errno > 0) {die('Imposible conectar [' . $db->connect_error . ']');}

			$metodop = "ingreso banco";
			$estado = "pedido";
			if (isset($_SESSION['usuario'])) {
				// Usuario al que se le enviará el MAIL
				$user = $_SESSION['usuario'];
			} elseif (isset($_SESSION['usuariofront'])) {
				$user = $_SESSION['usuariofront'];
			}

			$query = "INSERT INTO pedidos(idmetodopago,estado,username)
				VALUES ('$metodop','$estado','$user');";
			// al cancelar el pedido hay que eliminar lo que has hecho
			$result_vpro = $db->query($query) or die($db->connect_error . " en la línea " . $db->connect_errno);

			$querypedido = "SELECT MAX(idpedido) AS 'maxpedido' FROM pedidos WHERE username = '$user'";
			$resultado = mysqli_query($db, $querypedido);
			$registro = mysqli_fetch_array($resultado)['maxpedido'];

			// Area usuarios
			$verproductos = "SELECT * FROM usuarios WHERE username = '$user'";
			$resul_prod = $db->query($verproductos) or die($db->connect_error . " en la línea " . $db->connect_errno);
			$datos = $resul_prod->fetch_array(MYSQLI_BOTH);
			$username = $datos['username'];
			$direccion = $datos['direccion'];
			$email = $datos['email'];
			// echo "Correo" . $email . " electronico<br>";

			foreach ($_SESSION['carrito'] as $value) {
				$actu = "UPDATE productos SET cantidad = cantidad - " . $value['cantidad'] . " WHERE idproducto = '" . $value['id'] . "';";
				mysqli_query($db, $actu);
				$query = "INSERT INTO pedidos_has_productos VALUES ('$registro','" . $value['id'] . "');";
				mysqli_query($db, $query);
			}
			//header('location:index.php?sec=cancelar');
			if (!is_dir("../../factura/control")) {
				// Miram si el directori ja existeix i si no el cream
				mkdir("../../factura/control");
			}
			desconectarBD($db);
			facturaPDF($registro, $username, $direccion);
			carritoPDF($registro);
			envio($registro, $email, $username);

		}
	} else {
		echo "FIRMA KO";
		header("Location:http:../../index.php?sec=listapedido");
	}
}

?>
</body>
</html>