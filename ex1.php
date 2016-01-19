<?php
require('fpdf/fpdf.php');



$pdf = new FPDF();//valores por defecto que son página A4 con orientación vertical y el tamaño medido en milímetros
/*El primer parámetro del constructor permite elegir entre orientación vertical (L)
 u horizontal (P). El segundo parámetro sirve para que las medidas
de referencia se hagan en base a puntos (pt), milímetros (mm), centímetro
(cm) o pulgadas (in). El último parámetro nos ofrece la oportunidad de
elegir entre los diferentes formatos de página que existen: A3, A4, A5, Letter
y Legal.*/

//MEtodos de la clase
//var_dump(get_class_methods($pdf));


//PAGINA 1: Write
$pdf->AddPage(); //añade una página al documento con la orientación que le pida

$pdf->SetFont('Arial' , 'B' , 15) ; //selecciona una fuente tomando como parámetro el tipo, la propiedad (negrita, cursiva) y el tamaño
$pdf->Write(155 , ' Mi primer documento!!!'); //Write(altura,texto,enlace)-> Imprime el texto pasado como parámetro en la posición que indica el cursor.

$pdf->SetFont('Helvetica' , 'I' , 15) ; //selecciona una fuente tomando como parámetro el tipo, la propiedad (negrita, cursiva) y el tamaño
$pdf->Write(165 , ' Mi primer documento!!!');

$pdf->SetFont('Arial' , '' , 15) ; //selecciona una fuente tomando como parámetro el tipo, la propiedad (negrita, cursiva) y el tamaño
$pdf->Write(180 , ' Mi primer documento!!!',"http://www.googles.es");





//PAGINA 2: La Celda
$pdf->AddPage();
$pdf->SetFont('Courier','' ,10);

$pdf->Cell(80);
$pdf->Cell (20,10,'Titulo' ,'LR',1,'C');

$pdf->Cell(50);
$pdf->Cell (40,10,'Enlace a google' ,1,1,'C',0,"http://www.google.es");



//PAGINA 3: El cursor
$pdf->AddPage();
$pdf->SetXY(100,100);//SetX () y S e tY () colocan el texto en el punto indicado, en la medida seleccionada
$pdf->write(20,"Este texto se mostrará a 10 cm del margen");



$pdf->Output(); //Genera el PDF

?>