 <?php 
	 
	if(empty($_SESSION['usuariofront']) || empty($_SESSION['usuario']) || !empty($_SESSION['usuariofront']) || !empty($_SESSION['usuario'])){

 ?>

<form action="indexp.php?sec=listapedido&id=<?php echo $_REQUEST['id']?>" method="POST">

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
							JOIN categorias USING(idcategoria) WHERE idproducto='$id' GROUP BY idproducto;";
			$resultado = mysqli_query($db,$verproductos);
			
				while ($registro = mysqli_fetch_array($resultado)){
					
						echo "<tr>";
						echo "<td><img id='imagen' src='../backoffice/".$registro['ruta']."'alt='imagen'></img></td>";
						echo "<td class='textupper'>".$registro['titulo']."</td>";
						echo "<td class='textupper'>".$registro['descripcion']."</td>";
						echo "<td class='textupper'>".$registro['precio']."</td>";
						echo "<td class='textupper'>".$registro['marca']."</td>";
						
						echo "<td>";
							$cantidad = $registro['cantidad'];
							if($cantidad > 0){
								echo "<select name='cantidad'>";
								for ($i=1; $i <= $cantidad ; $i++) { 
									echo "<option value='$i'>$i</option>";
								}
								echo "</select>";
							}else if($cantidad <= 0){
								echo "<h2>No hay productos por ahora</h2>";
							}
						echo "</td>";
						echo "</tr>";
				}

		}
		

		$db->close();

 ?>

 </table>
 	<button class="btn"><a href="indexp.php?sec=patines">Seguir pidiendo</a></button>
 	<?php if($cantidad <= 0){

 		?>
 		<span class="btn">No puede pedir este articulo</span>
 		<?php } else{ ?>
	<button class="btn" type="submit">Pedir</button>
	<?php } ?>
</form>

<?php 
	}
 ?>