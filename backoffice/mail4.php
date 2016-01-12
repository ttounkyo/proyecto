<?php
//Haurem de descarregar previament la llibreria
//https://github.com/PHPMailer/PHPMailer
require_once '../backoffice/PHPMailer-master/class.phpmailer.php';

$email = new PHPMailer();
$email->From      = 'aa.antonio.delgado@gmail.com';
$email->FromName  = 'Jose';
$email->Subject   = 'Missatge';
$email->Body      = "Hola que tal";
$email->AddAddress( 'aa.antonio.delgado@gmail.com' );
//$email->AddAddress( 'desti2' );

$file_to_attach = $_SERVER['DOCUMENT_ROOT']."//logo.png";
echo $file_to_attach,
// $email->AddAttachment( $file_to_attach , 'logo.png' );

// $email->AddAttachment( $_SERVER['DOCUMENT_ROOT']."/img/cristalina.jpg" , 'cristalina' );

if($email->Send()){
	echo "mensaje enviado";
}else{
	echo "no enviado";
}



?>