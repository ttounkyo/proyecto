﻿<h1>Compras</h1>

<?php
if (!empty($_SESSION['usuariofront']) || !empty($_SESSION['usuario'])) {

	require_once "../funciones.php";
	$db = conectarBD();
	if ($db->connect_errno > 0) {die('Imposible conectar [' . $db->connect_error . ']');}

	$metodop = $_POST['pago'];
	$estado = $_POST['estado'];
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

	foreach ($_SESSION['carrito'] as $value) {
		$actu = "UPDATE productos SET cantidad = cantidad - " . $value['cantidad'] . " WHERE idproducto = '" . $value['id'] . "';";
		mysqli_query($db, $actu);
		$query = "INSERT INTO pedidos_has_productos VALUES ('$registro','" . $value['id'] . "');";
		mysqli_query($db, $query);
	}
	//header('location:index.php?sec=cancelar');
	desconectarBD($db);

}
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF
//ob_clean();
require 'invoice.php';
//ob_get_clean();
$pdf = new PDF_Invoice('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->addSociete("TTOUNKYO",
	"Dirección\n" .
	"07840 ESPAÑA\n" .
	"Calle Ignacio Walis s/n\n");
$pdf->fact_dev("Divisa", "001 ");
$pdf->temporaire("FACTURA");
$pdf->addDate(date('d/m/Y'));
$pdf->addClient($username);
$pdf->addPageNumber("1");
$pdf->addClientAdresse($direccion);
$pdf->addReglement("Compra atraves de tarjeta");
$pdf->addVencimiento(date('d/m/Y', strtotime('+1 year')));
$pdf->addNumNif($registro);
$pdf->addReference("Detalle de la compra");
$cols = array(
	"REFERENCIA" => 23,
	"DESIGNACIÓN" => 78,
	"CANTIDAD" => 22,
	"P.UNIDAD. HT" => 26,
	"TOTAL  H.T." => 30,
	"I.V.A." => 11);
$pdf->addCols($cols);
$cols = array(
	"REFERENCIA" => "L",
	"DESIGNACIÓN" => "L",
	"CANTIDAD" => "C",
	"P.UNIDAD. HT" => "R",
	"TOTAL  H.T." => "R",
	"I.V.A." => "C");
$pdf->addLineFormat($cols);
$pdf->addLineFormat($cols);
$preu_final = 0;
$y = 109;
foreach ($_SESSION['carrito'] as $key => $value) {
	$line = array(
		"REFERENCIA" => $value['titulo'],
		"DESIGNACIÓN" => $value['descripcion'],
		"CANTIDAD" => $value['cantidad'],
		"P.UNIDAD. HT" => $value['precio'] . " " . EURO,
		"TOTAL  H.T." => ($value['cantidad'] * $value['precio']) . " " . EURO,
		"I.V.A." => "1");
	$size = $pdf->addLine($y, $line);
	$y += $size + 2;
	$preu_final += ($value['cantidad'] * $value['precio']);
}

$pdf->addCadreTVAs();

$tot_prods = array(array("px_unit" => $preu_final, "qte" => 1, "tva" => 1),
	array("px_unit" => 10, "qte" => 1, "tva" => 1));
$tab_tva = array(
	"1" => 21.0,
	"2" => 5.5);
$params = array(
	"RemiseGlobale" => 0,
	"remise_tva" => 0, // {la remise s'applique sur ce code TVA}
	"remise" => 0, // {montant de la remise}
	"remise_percent" => 0, // porcentaje de descuento sobre el importe del IVA
	"FraisPort" => 1,
	"portTTC" => 0, //importe de los costes de envío IVA
	// par defaut la TVA = 19.6 %
	"portHT" => 0, // montant des frais de ports HT
	"portTVA" => 21.0, // valor del IVA que se aplicará a la cantidad neta
	"AccompteExige" => 0,
	"accompte" => 0, // montant de l'acompte (TTC)
	"accompte_percent" => 0, // pourcentage d'acompte (TTC)
	"Remarque" => "A ver si hay descuento");

$pdf->addTVAs($params, $tab_tva, $tot_prods);
$pdf->addCadreEurosFrancs();
ob_get_clean();
$pdf->Output();
?>