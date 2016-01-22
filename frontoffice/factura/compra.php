<h1>Compras</h1>

<?php
	if(!empty($_SESSION['usuariofront']) || !empty($_SESSION['usuario'])&& isset($_REQUEST['id'])){

		require_once("../funciones.php");
		$db = conectarBD();
		if($db->connect_errno > 0){die('Imposible conectar [' . $db->connect_error . ']');}

		$metodop 	= $_POST['pago'];
		$estado  	= $_POST['estado'];
		if(isset($_SESSION['usuario'])){
			// Usuario al que se le enviará el MAIL
			$user  	= $_SESSION['usuario'];
		}elseif(isset($_SESSION['usuariofront'])){
			$user  	= $_SESSION['usuariofront'];
		}
		
		// $cantidad	= $_POST['cantidad'];
		// $id      	= $_REQUEST['id'];
		$i = 0;
		$j = 0;
		while ($i < count($_SESSION['id']) && $j < count($_SESSION['can'])){
			$actu 		= "UPDATE productos SET cantidad = cantidad - ".$_SESSION['can'][$j]." WHERE idproducto = '".$_SESSION['id'][$i]."';";
			$res = $db->query($actu) or die ($db->connect_error. " en la línea ");
			$i++;
			$j++;
		}

		$query 	= "INSERT INTO pedidos(idmetodopago,estado,username)
				VALUES ('$metodop','$estado','$user');";
		$result_vpro = $db->query($query) or die ($db->connect_error. " en la línea ");

		$querypedido = "SELECT MAX(idpedido) AS 'maxpedido' FROM pedidos WHERE username = '$user'";
		$resultado = mysqli_query($db,$querypedido);
		$registro = mysqli_fetch_array($resultado)['maxpedido'];
		$i = 0;
		while ( $i < count($_SESSION['id'])){
			$query 		= "INSERT INTO pedidos_has_productos
	 		VALUES ('$registro','".$_SESSION['id'][$i]."');";
	 		mysqli_query($db,$query);
	 		$i++;
		}


		//header('location:index.php?sec=cancelar');
		desconectarBD($db);
	
}
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF

require('invoice.php');

// ob_start();
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete( "TTOUNKYO",
                  "Dirección\n" .
                  "07840 ESPAÑA\n".
                  "Calle Ignacio Walis s/n\n");
$pdf->fact_dev( "Divisa", "001 " );
$pdf->temporaire( "FACTURA" );
$pdf->addDate( "18/01/2016");
$pdf->addClient("CL01");
$pdf->addPageNumber("1");
$pdf->addClientAdresse("Ste\nM. XXXX\n3ème étage\n33, rue d'ailleurs\n75000 PARIS");
$pdf->addReglement("Cheque a recepción de factura");
$pdf->addVencimiento("03/12/2003");
$pdf->addNumNif("FR888777666");
$pdf->addReference("Devis ... du ....");
$cols=array( "REFERENCIA"    => 23,
             "DESIGNACIÓN"  => 78,
             "CANTIDAD"     => 22,
             "P.UNIDAD. HT"      => 26,
             "TOTAL  H.T." => 30,
             "I.V.A."          => 11 );
$pdf->addCols( $cols);
$cols=array( "REFERENCIA"    => "L",
             "DESIGNACIÓN"  => "L",
             "CANTIDAD"     => "C",
             "P.UNIDAD. HT"      => "R",
             "TOTAL  H.T." => "R",
             "I.V.A."          => "C" );
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);

	$y    = 109;
	foreach ($_SESSION['carrito'] as $key => $value) {
		$line = array( "REFERENCIA"    => $value['titulo'],
		               "DESIGNACIÓN"  => $value['descripcion'],
		               "CANTIDAD"     => $value['cantidad'],
		               "P.UNIDAD. HT"      => $value['precio'] ." ".EURO,
		               "TOTAL  H.T." => ($value['cantidad'] * $value['precio']) ." ".EURO,
		               "I.V.A."          => "1" );
		$size = $pdf->addLine( $y, $line );
		$y   += $size + 2;
	}



$pdf->addCadreTVAs();
        
// invoice = array( "px_unit" => value,
//                  "qte"     => qte,
//                  "tva"     => code_tva );
// tab_tva = array( "1"       => 19.6,
//                  "2"       => 5.5, ... );
// params  = array( "RemiseGlobale" => [0|1],
//                      "remise_tva"     => [1|2...],  // {la remise s'applique sur ce code TVA}
//                      "remise"         => value,     // {montant de la remise}
//                      "remise_percent" => percent,   // {pourcentage de remise sur ce montant de TVA}
//                  "FraisPort"     => [0|1],
//                      "portTTC"        => value,     // montant des frais de ports TTC
//                                                     // par defaut la TVA = 19.6 %
//                      "portHT"         => value,     // montant des frais de ports HT
//                      "portTVA"        => tva_value, // valeur de la TVA a appliquer sur le montant HT
//                  "AccompteExige" => [0|1],
//                      "accompte"         => value    // montant de l'acompte (TTC)
//                      "accompte_percent" => percent  // pourcentage d'acompte (TTC)
//                  "Remarque" => "texte"              // texte
$tot_prods = array( array ( "px_unit" => 600, "qte" => 1, "tva" => 1 ),
                    array ( "px_unit" =>  10, "qte" => 1, "tva" => 1 ));
$tab_tva = array( "1"       => 19.6,
                  "2"       => 5.5);
$params  = array( "RemiseGlobale" => 1,
                      "remise_tva"     => 1,       // {la remise s'applique sur ce code TVA}
                      "remise"         => 0,       // {montant de la remise}
                      "remise_percent" => 10,      // {pourcentage de remise sur ce montant de TVA}
                  "FraisPort"     => 1,
                      "portTTC"        => 10,      // montant des frais de ports TTC
                                                   // par defaut la TVA = 19.6 %
                      "portHT"         => 0,       // montant des frais de ports HT
                      "portTVA"        => 19.6,    // valeur de la TVA a appliquer sur le montant HT
                  "AccompteExige" => 1,
                      "accompte"         => 0,     // montant de l'acompte (TTC)
                      "accompte_percent" => 15,    // pourcentage d'acompte (TTC)
                  "Remarque" => "Avec un acompte, svp..." );

$pdf->addTVAs( $params, $tab_tva, $tot_prods);
$pdf->addCadreEurosFrancs();
ob_end_clean();
$pdf->Output();
// ob_end_flush();
unset($_SESSION['id']);
unset($_SESSION['can']);
unset($_SESSION['carrito']);
?>