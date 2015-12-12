<?php 
	
	

 ?>

 <form action="index.php?sec=pedido">
 	<div>
 		<label for="">Metodo de pago.</label>
 		<br>
 		<select name="pago">
		  <option value="paypal">PayPal</option>
		  <option value="mastercard">MasterCard</option>
		  <option value="visa" selected>Visa</option>
		</select>
 	</div>
 	<br>
 	<div>
 		<label for="">Estado</label>
 		<br>
 		<input type="text" name="">
 	</div>
 	<button><a href="index.php?sec=producto">Seguir pidiendo</a></button>
 </form>