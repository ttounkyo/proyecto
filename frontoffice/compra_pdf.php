<?php
/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the LGPL License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2016 Laurent MINGUET
 */
require_once "../html2pdf/vendor/autoload.php";
// ini_set("session.auto-start", 0);
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

try {
	//ob_clean();
	ob_start();
	include dirname(__FILE__) . './compra_aux.php';
	$content = ob_get_clean();

	$html2pdf = new Html2Pdf('P', 'A4', 'fr');
	// $content = ob_get_clean();
	$html2pdf->writeHTML($content);
	// ob_end_clean();
	$html2pdf->Output('recibo.pdf');

} catch (Html2PdfException $e) {
	$formatter = new ExceptionFormatter($e);
	echo $formatter->getHtmlMessage();
}
?>