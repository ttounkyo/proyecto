<h1>Compras</h1>

<?php

	if(!empty($_SESSION['usuariofront']) || !empty($_SESSION['usuario'])&& isset($_REQUEST['id'])){

		$db = new mysqli('localhost', 'root', '', 'ttounkyo');
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
		
		$cantidad	= $_POST['cantidad'];
		$id      	= $_REQUEST['id'];

		$actu 		= "UPDATE productos SET cantidad = cantidad - $cantidad WHERE idproducto = $id;";
		$res = $db->query($actu) or die ($db->connect_error. " en la línea ");
		// ya funciona pedidos hahahahah
		$query 		= "INSERT INTO pedidos(idmetodopago,estado,username)
				VALUES ('$metodop','$estado','$user');";
		$result_vpro = $db->query($query) or die ($db->connect_error. " en la línea ");
		$db->close();
	}
	elseif(isset($_SESSION['usuario']) || empty($_SESSION['usuario']) || isset($_SESSION['usuariofront']) || empty($_SESSION['usuariofront'])){
		echo "Tienes que iniciar session";
	}

?>