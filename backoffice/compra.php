<h1>Compras</h1>

<?php
	if(isset($_POST['pago']) && isset($_POST['idproducto'])){
		$db = new mysqli('localhost', 'root', '', 'ttounkyo');
		if($db->connect_errno > 0){
		    die('Imposible conectar [' . $db->connect_error . ']');
		}
		$metodop 	= $_POST['pago'];
		$estado  	= $_POST['estado'];
		$user    	= $_SESSION['usuario'];
		$cantidad	= $_POST['cantidad'];
		$id      	= $_POST['idproducto'];

		$actu 		= "UPDATE productos SET cantidad = cantidad - $cantidad WHERE idproducto = $id;";
		$resultado  = mysqli_query($db,$actu);

		$query 		= "INSERT INTO pedido(idmetodopago,estado,username)
				VALUES ('$metodop','$estado','$user');";
			
		$db->close();
	}

?>