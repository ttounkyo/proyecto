<?php
require('fpdf/fpdf.php');
 
class PDF extends FPDF
{
//La clase FPDF implementa el método header () que se llama cada vez que existe un salto de página.
function Header()
{
    //Logo
    /*
    Image(fichero, x, y, ancho, alto, tipo, enlace)
    • fichero: Indica la ruta hacia el fichero que va a insertar.
    • x: Posición en el eje x de la imagen.
    • y: Posición en el eje y de la imagen.
    • ancho: Ancho de la imagen.
    • alto: Alto de la imagen. Si no se indica y el parámetro ancho está definido,
    el alto se escala en función del ancho.
    • tipo: El tipo de imagen. Por ahora sólo se aceptan imágenes JPG, JPEG
    y PNG.
    • enlace: La imagen puede ser un enlace.
    */
    $this->Image('foto.png',10,10,33,20,'PNG','http://www.google.es');


    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Move to the right
    $this->Cell(80); //$this->SetX(80);
    
    //Title
    $this->Cell(30,10,'Title',1,0,'C');
    //Line break
    $this->Ln(30); //El método Ln (2 0 ) inserta un salto de línea cuya altura es determinada por el argumento.
}
 
//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->AliasNbPages();//cuenta el número de páginas cuando el documento está cerrado y sustituye la marca {nb} por este número
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
 
//Instanciation of inherited class
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
//Salto de página automàtico

//El código anterior activa el salto de página automático cuando el texto lleguea 3 centímetros del margen inferior. Por defecto esta a 2 cms
$pdf->SetAutoPageBreak(true,30); 

for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'Printing line number '.$i,0,1);


$pdf->Output("algo.pdf","D"); //Nos aparece la opción de descargar el pdf
?>



