 <?php 
	$db = new mysqli('localhost', 'root', '', 'ttounkyo');
	if($db->connect_errno > 0){
	    die('Imposible conectar [' . $db->connect_error . ']');
	}
 ?>

 <form action="index.php?sec=pedido&id=<?php echo $_REQUEST['id']?>">
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
 	<button type="submit">Comprar</button>
 </form>



<table id="listadopro">
	<tr>
	<th>Identificador</th>
	<th>Titulo</th>
	<th>Descripcion</th>
	<th>Precio</th>
	<th>Marca</th>
	<th>Imagen</th>
	<th>Cantidad</th>
	<th>Creado</th>
	<th>Categoria</th>
	<th>Eliminar</th>
	<th>Modificar</th>
	<th>Seleccionar</th>
	</tr>

<?php 
		$id = $_REQUEST['id'];
		$verproductos = "SELECT * FROM productos JOIN categorias_productos USING (idproducto)
						JOIN categorias USING(idcategoria) WHERE idproducto='$id';";
		$resultado = mysqli_query($db,$verproductos);
		
		if(!empty($id){
			while ($registro = mysqli_fetch_array($resultado)){
				$id 	= $registro['idproducto'];
				echo "<tr>";
				echo "<td>".$id."</td>";
				echo "<td>".$registro['titulo']."</td>";
				echo "<td>".$registro['descripcion']."</td>";
				echo "<td>".$registro['precio']."</td>";
				echo "<td>".$registro['marca']."</td>";
				echo "<td><img id='imagen' src='".$registro['ruta']."'alt='imagen'></img></td>";
				echo "<td><input name='canselec' value='".$registro['cantidad']."'></td>";
				echo "<td>".$registro['createdAt']."</td>";
				echo "<td>".$registro['nombre']."</td>";
				echo "<td>"."<button><a href='index.php?sec=eliminarpro&id=".$id."'>Eliminar</a></button>"."</td>";
				echo "<td><button><a href='index.php?sec=modificarpro&cant=".$registro['cantidad']."&ctg=".$registro['nombre']."&m=".$registro['marca']."&id=".$id."&t=".$registro['titulo']."&p=".$registro['precio']."&d=".$registro['descripcion']."&img=".$registro['ruta']."'>Modificar</a></button></td>";
				echo "<td><button><a href='index.php?sec=pedido&id=".$id."'>Seleccionar</a></button></td>";
				echo "</tr>";	
			}
		}else {
			
			while ($registro = mysqli_fetch_array($resultado)){
				$id 	= $registro['idproducto'];
				echo "<tr>";
				echo "<td>".$id."</td>";
				echo "<td>".$registro['titulo']."</td>";
				echo "<td>".$registro['descripcion']."</td>";
				echo "<td>".$registro['precio']."</td>";
				echo "<td>".$registro['marca']."</td>";
				echo "<td><img id='imagen' src='".$registro['ruta']."'alt='imagen'></img></td>";
				echo "<td><input name='canselec' value='".$registro['cantidad']."'></td>";
				echo "<td>".$registro['createdAt']."</td>";
				echo "<td>".$registro['nombre']."</td>";
				echo "<td>"."<button><a href='index.php?sec=eliminarpro&id=".$id."'>Eliminar</a></button>"."</td>";
				echo "<td><button><a href='index.php?sec=modificarpro&cant=".$registro['cantidad']."&ctg=".$registro['nombre']."&m=".$registro['marca']."&id=".$id."&t=".$registro['titulo']."&p=".$registro['precio']."&d=".$registro['descripcion']."&img=".$registro['ruta']."'>Modificar</a></button></td>";
				echo "<td><button><a href='index.php?sec=pedido&id=".$id."'>Seleccionar</a></button></td>";
				echo "</tr>";	
			}
		}
		

		
		

		$db->close();

 ?>

 </table>