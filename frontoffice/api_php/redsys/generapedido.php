<?php

// Se incluye la librería
include 'apiRedsys.php';
// Se crea Objeto
$miObj = new RedsysAPI;

// Valores de entrada
$fuc = "TTOUNKYO";
$terminal = "871";
$moneda = "978";
$trans = "0";
$url = "http://ttounkyo-ttounkyo.rhcloud.com/frontoffice/";
$urlOKKO = "http://ttounkyo-ttounkyo.rhcloud.com/frontoffice/api_php/redsys/recepcionpedido.php";
$id = time(); // id pedido time()
$amount = $_REQUEST['cant'] . "00"; // Cantidad

// Se Rellenan los campos
$miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
$miObj->setParameter("DS_MERCHANT_ORDER", strval($id));
$miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $fuc);
$miObj->setParameter("DS_MERCHANT_CURRENCY", $moneda);
$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $trans);
$miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
$miObj->setParameter("DS_MERCHANT_MERCHANTURL", $url);
$miObj->setParameter("DS_MERCHANT_URLOK", $urlOKKO);
$miObj->setParameter("DS_MERCHANT_URLKO", $urlOKKO);

//Datos de configuración
$version = "HMAC_SHA256_V1";
$kc = 'Mk9m98IfEblmPfrpsawt7BmxObt98Jev'; //Clave recuperada de CANALES
// Se generan los parámetros de la petición
$request = "";
$params = $miObj->createMerchantParameters();
$signature = $miObj->createMerchantSignature($kc);

?>
<html lang="es">
<head>
</head>
<body>
<form name="frm" action="http://jguasch.esy.es/redsys/lacaixa.php" method="POST" target="_blank">
Ds_Merchant_SignatureVersion <input type="text" name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
Ds_Merchant_MerchantParameters <input type="text" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
Ds_Merchant_Signature <input type="text" name="Ds_Signature" value="<?php echo $signature; ?>"/></br>
<input type="submit" value="Enviar" >
</form>

</body>
</html>
