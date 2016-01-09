<h1>Compras</h1>

<?php

	if(!empty($_SESSION['usuariofront']) || !empty($_SESSION['usuario'])&& isset($_REQUEST['id'])){

		$db = new mysqli('mysql.hostinger.es', 'u121308368_boss', '162534Aa', '	u121308368_ttoun',3306);
		if($db->connect_errno > 0){
		    die('Imposible conectar [' . $db->connect_error . ']');
		}
		$metodop 	= $_POST['pago'];
		$estado  	= $_POST['estado'];
		if(isset($_SESSION['usuario'])){
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


		header('location:indexp.php?sec=cancelar');
		$db->close();
	}

?>