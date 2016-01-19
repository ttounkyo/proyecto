<?php
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF

require('invoice.php');

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
$line = array( "REFERENCIA"    => "REF1",
               "DESIGNACIÓN"  => "Carte Mère MSI 6378\n" .
                                 "Processeur AMD 1Ghz\n" .
                                 "128Mo SDRAM, 30 Go Disque, CD-ROM, Floppy, Carte vidéo",
               "CANTIDAD"     => "1",
               "P.UNIDAD. HT"      => "600.00",
               "TOTAL  H.T." => "600.00",
               "I.V.A."          => "1" );
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;

$line = array( "REFERENCIA"    => "REF2",
               "DESIGNACIÓN"  => "Câble RS232",
               "CANTIDAD"     => "6",
               "P.UNIDAD. HT"      => "10.00",
               "TOTAL  H.T." => "60.00",
               "I.V.A."          => "1" );
$size = $pdf->addLine( $y, $line );
$y   += $size + 2;

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
$pdf->Output();
?>