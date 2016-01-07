 <?php 
	$db = new mysqli('localhost', 'root', '', 'ttounkyo');

 ?>

 <form action="indexp.php?sec=pedido&id=<?php echo $_REQUEST['id']?>">
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
 	<button><a href="indexp.php?sec=patines">Seguir pidiendo</a></button>
 	<button type="submit">Comprar</button>
 </form>



<table id="listadopro">
	<tr>
	<th>Imagen</th>
	<th>Titulo</th>
	<th>Descripcion</th>
	<th>Precio</th>
	<th>Marca</th>
	<th>Cantidad</th>
<?php 
	if($_SESSION['rol']== 'administrador'){
		// Para agregar el contenido
 ?>
	<th>Eliminar</th>
	<th>Modificar</th>
<?php 
	}
 ?>
	</tr>

<?php 
		

		
		if(isset($_REQUEST['id'])){
			$id = $_REQUEST['id'];
			$verproductos = "SELECT * FROM productos JOIN categorias_productos USING (idproducto)
							JOIN categorias USING(idcategoria) WHERE idproducto='$id' LIMIT 1;";
			$resultado = mysqli_query($db,$verproductos);
			
				while ($registro = mysqli_fetch_array($resultado)){
					$id 	= $registro['idproducto'];
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
					if($_SESSION['rol']== 'administrador'){
						echo "<td>"."<button><a href='index.php?sec=eliminarpro&id=".$id."'>Eliminar</a></button>"."</td>";
						echo "<td><button><a href='index.php?sec=modificarpro&cant=".$registro['cantidad']."&ctg=".$registro['nombre']."&m=".$registro['marca']."&id=".$id."&t=".$registro['titulo']."&p=".$registro['precio']."&d=".$registro['descripcion']."&img=".$registro['ruta']."'>Modificar</a></button></td>";
					}
					
					echo "</tr>";	
				
				}
		}
		

		$db->close();

 ?>

 </table>