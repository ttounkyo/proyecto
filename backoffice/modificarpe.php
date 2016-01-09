<?php 

	if(isset($_REQUEST['id']) && isset($_REQUEST['esta']) && isset($_REQUEST['pago'])){
		$estado 	= $_REQUEST['esta'];
		$metodo     = $_REQUEST['pago'];
		$id 	= $_REQUEST['id'];
		$db = new mysqli('db608606955.db.1and1.com', 'dbo608606955', '162534Aa', 'db608606955');
		
		$sql = "UPDATE pedidos SET idmetodopago = '$metodo', estado ='$estado' WHERE idpedido = '$id';";
		mysqli_query($db,$sql);
		header('location:index.php?sec=compra');
		$db->close();
	}

 ?>

 <form class='pedido' action='index.php?sec=modificarpe&id=<?php echo $_REQUEST['id']?>' method='POST'>
	<h1>Modificar Pedido</h1>
	<div>
		<label for="">Id Pedido</label>
		<br>
		<input type="text"disabled value='<?php echo $_REQUEST['id']?>'>
	</div>
	<div>
		<label for="">Nuevo estado: </label>
		<br>
		<input type='text' value='<?php echo $_REQUEST['est']?>' name='esta' />
	</div>
	<div>
		<label for="">Nuevo metodo de pago: </label>
		<br>
		<select name="pago">
		  <option value="paypal">PayPal</option>
		  <option value="mastercard">MasterCard</option>
		  <option value="visa" selected>Visa</option>
		</select>
	</div>
	<div >
	<button class="btn" type='submit' name='enviar'>Enviar</button>
	</div>
</form>