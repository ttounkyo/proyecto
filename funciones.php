<?php
/**
 *Función que crea y devuelve un objeto de conexión a la base de datos y chequea el estado de la misma.
 */
function conectarBD() {

	$BD = "ttounkyo";
	$server = getenv("OPENSHIFT_MYSQL_DB_HOST");
	if (!empty($server)) {
		$usuario = "admin9kDV7Ta";
		$pass = "XnDEf3TQ2a68";
	} else {
		$server = "localhost";
		$usuario = "root";
		$pass = "";
	}

	//variable que guarda la conexión de la base de datos
	$conexion = mysqli_connect($server, $usuario, $pass, $BD);
	//devolvemos el objeto de conexión para usarlo en las consultas
	return $conexion;
}

/*Desconectar la conexion a la base de datos*/
function desconectarBD($conexion) {
	//Cierra la conexión y guarda el estado de la operación en una variable
	$close = mysqli_close($conexion);
	//devuelve el estado del cierre de conexión
	return $close;
}
// $db = new mysqli("mysql://$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT/", "admin9kDV7Ta", "XnDEf3TQ2a68", "ttounkyo");

if (!function_exists("hash_equals")) {
	function hash_equals($a, $b) {
		return substr_count($a ^ $b, "\0") * 2 === strlen($a . $b);
	}
}

// Mirar lo que devuelve bien los parametros.
// function breadcrumbs($separator = ' &raquo; ', $home = 'Home') {
// 	$path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
// 	$base = 'https' . '://' . $_SERVER['HTTP_HOST'] . '/';
// 	$breadcrumbs = array('<a href="' . $base . '">' . $home . '</a>');

// 	$last = end(array_keys($path));

// 	foreach ($path as $x => $crumb) {
// 		$title = ucwords(str_replace(array('.php', '_'), array('', ' '), $crumb));

// 		if ($x != $last) {
// 			$breadcrumbs[] = '<a href="' . $base . $crumb . '">' . $title . '</a>';
// 		} else {
// 			$breadcrumbs[] = $title;
// 		}
// 	}
// 	return implode($separator, $breadcrumbs);
// }

function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
	$file = $path . $filename;
	$file_size = filesize($file);
	$handle = fopen($file, "r");
	$content = fread($handle, $file_size);
	fclose($handle);
	$content = chunk_split(base64_encode($content));
	$uid = md5(uniqid(time()));
	$name = basename($file);

	$header = "From: " . $from_name . " <" . $from_mail . ">\n";
	$header .= "Reply-To: " . $replyto . "\n";
	$header .= "MIME-Version: 1.0\n";
	$header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\n\n";
	$emessage = "--" . $uid . "\n";
	$emessage .= "Content-type:text/html; charset=iso-8859-1\n";
	$emessage .= "Content-Transfer-Encoding: 7bit\n\n";
	$emessage .= $message . "\n\n";
	$emessage .= "--" . $uid . "\n";
	$emessage .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\n"; // use different content types here
	$emessage .= "Content-Transfer-Encoding: base64\n";
	$emessage .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\n\n";
	$emessage .= $content . "\n\n";
	$emessage .= "--" . $uid . "--";

	mail($mailto, $subject, $emessage, $header);
	if (mail($mailto, $subject, "", $header)) {
		echo "mail send ... OK"; // or use booleans here
	} else {
		echo "mail send ... ERROR!";
	}

}

function facturaPDF($registro, $username, $direccion) {
	// (c) Xavier Nicolay
	// Exemple de génération de devis/facture PDF
	//ob_clean();
	require '../../factura/invoice.php';
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
		array("px_unit" => 0, "qte" => 1, "tva" => 1));
	$tab_tva = array(
		"1" => 21.0,
		"2" => 5.5);
	$params = array(
		"RemiseGlobale" => 1,
		"remise_tva" => 1, // {la remise s'applique sur ce code TVA}
		"remise" => 0, // {montant de la remise}
		"remise_percent" => 10, // porcentaje de descuento sobre el importe del IVA
		"FraisPort" => 1,
		"portTTC" => 0, //importe de los costes de envío IVA
		// par defaut la TVA = 19.6 %
		"portHT" => 0, // montant des frais de ports HT
		"portTVA" => 21.0, // valor del IVA que se aplicará a la cantidad neta
		"AccompteExige" => 1,
		"accompte" => 0, // montant de l'acompte (TTC)
		"accompte_percent" => 15, // pourcentage d'acompte (TTC)
		"Remarque" => "Descuento del 15% en todos nuestros productos");

	$pdf->addTVAs($params, $tab_tva, $tot_prods);
	$pdf->addCadreEurosFrancs();
// ob_get_clean();
	$pdf->Output("../factura/control/factura" . $registro . ".pdf", "F");
}

function carritoPDF($registro) {
	try {
		//ob_clean();
		$content = "";
		ob_start();
		include 'carro_pdf.php';
		$content = ob_get_clean();

		$html2pdf = new Html2Pdf('P', 'A4', 'fr');
		// $content = ob_get_clean();
		$html2pdf->writeHTML($content);

		$html2pdf->Output("../factura/control/carro" . $registro . ".pdf", "F");
		ob_get_clean();
		// $html2pdf->Output();
	} catch (Html2PdfException $e) {
		$formatter = new ExceptionFormatter($e);
		echo $formatter->getHtmlMessage();
	}
}

function envio($registro, $email, $username) {
	$correo = new PHPMailer(); //Creamos una instancia en lugar usar mail()
	$cabeceras = 'ttounkyo@gmail.com';
//Usamos el SetFrom para decirle al script quien envia el correo
	$correo->SetFrom($cabeceras, "Cuenta de administrador");
//Usamos el AddReplyTo para decirle al script a quien tiene que responder el correo
	$correo->AddReplyTo($cabeceras, "Cuenta de administrador");
//Usamos el AddAddress para agregar un destinatario
	$correo->AddAddress($email);
//Ponemos el asunto del mensaje
	$correo->Subject = "Factura";
	$correo->IsHTML(false);
	$correo->Body = "Gracias por comprar nuestros productos";

//Si deseamos agregar un archivo adjunto utilizamos AddAttachment
	$correo->AddAttachment("../factura/control/factura" . $registro . ".pdf", "FACTURA");
	$correo->AddAttachment("../factura/control/carro" . $registro . ".pdf", "CARRO");
//Enviamos el correo
	if (!$correo->Send()) {
		echo "Hubo un error: " . $correo->ErrorInfo . "<br>";
	} else {
		echo "Mensaje enviado con exito a " . $username . "<br>";
		unset($_SESSION['carrito']);
		header("Location: ../index.php");
	}
}

?>