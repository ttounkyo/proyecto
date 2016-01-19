<?php
require_once('fpdf/fpdf.php');

class PDF extends FPDF
{
	function tabla($cabecera,$datos)
	{
		$this->cabecera ($cabecera) ;
		$this->datos($datos);
	}

	function cabecera($cabecera)
	{
		//Cabecera
		$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco) 
		$this->SetFillColor(0, 0, 255); // establece el color del fondo de la celda (en este caso es AZUL 
		$this->SetDrawColor(0,255,0); // establece el color del borde de la celda (en este caso es VERDE )

		$this->SetFont('Arial','B',15);
		foreach($cabecera as $columna) {
			$this->Cell(40,7,utf8_decode($columna),1, 0 ,'C',True ) ;
		}
		$this->Ln();
	}

	function datos($datos)
	{
		//Datos
		$this->SetTextColor (0,255,255);
		$this->SetDrawColor(0,255,0); // establece el color del borde de la celda (en este caso es VERDE )


		$this->SetFont('Arial','',12);
		foreach ($datos as $dato) {
			foreach ($dato as $columna) {
				$this->Cell(40,7,utf8_decode($columna),1,0,'C');
			}
		$this->Ln();
	}

	}
}

$pdf = new PDF();
$pdf->AddPage();

$cabecera = array("Usuarios","Visitas","Localidad","Teléfono");

$datos = array(array("Luis Miguel ","12","Badajoz","555345678"),
				array("María Fernanda", "45" , "Mérida", "234234654") ,
				array("Pedro Casas","3","Cáceres","342123 890")) ;

$pdf->tabla($cabecera,$datos);

$pdf->Output();

?>