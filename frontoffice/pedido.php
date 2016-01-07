 <?php 
	$db = new mysqli('localhost', 'root', '', 'ttounkyo');

 ?>

<form action="indexp.php?sec=compra&id=<?php echo $_REQUEST['id']?>" method="GET">
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
 		<input type="text" name="" value="enviado">
 	</div>




<table id="listadopro">
	<tr>
	<th>Imagen</th>
	<th>Titulo</th>
	<th>Descripcion</th>
	<th>Precio</th>
	<th>Marca</th>
	<th>Cantidad</th>
	</tr>

<?php 
		

		
		if(isset($_REQUEST['id'])){
			$id = $_REQUEST['id'];
			$verproductos = "SELECT * FROM productos JOIN categorias_productos USING (idproducto)
							JOIN categorias USING(idcategoria) WHERE idproducto='$id' LIMIT 1;";
			$resultado = mysqli_query($db,$verproductos);
			
				while ($registro = mysqli_fetch_array($resultado)){
					echo "<tr>";
					echo "<td><img id='imagen' src='".$registro['ruta']."'alt='imagen'></img></td>";
				
					echo "<td>".$registro['titulo']."</td>";
					echo "<td>".$registro['descripcion']."</td>";
					echo "<td>".$registro['precio']."</td>";
					echo "<td>".$registro['marca']."</td>";
					
					echo "<td>";
						$cantidad = $registro['cantidad'];
						if($cantidad !=0){
							echo "<select name='cantidad'>";
							for ($i=1; $i <= $cantidad ; $i++) { 
								echo "<option value='$i'>$i</option>";
							}
							echo "</select>";
						}else{
							echo "<h2>No hay productos por ahora</h2>";
						}
					echo "</td>";
					echo "</tr>";	
				
				}
		}
		

		$db->close();

 ?>

 </table>

  	<button><a href="indexp.php?sec=patines">Seguir pidiendo</a></button>
 	<button type="submit">Comprar</button>
</form>