 <?php 
	$db = new mysqli('localhost', 'root', '', 'ttounkyo');
	if(empty($_SESSION['usuariofront']) || empty($_SESSION['usuario']) || !empty($_SESSION['usuariofront']) || !empty($_SESSION['usuario'])){

 ?>

<form action="indexp.php?sec=compra&id=<?php echo $_REQUEST['id']?>" method="POST">
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
 		<input type="text" name="estado" value="Pedido">
 	</div>


<table id="listadopro">
	<tr>
	<th>Imagen</th>
	<th>Id</th>
	<th>Titulo</th>
	<th>Descripcion</th>
	<th>Precio</th>
	<th>Marca</th>
	<th>Cantidad</th>
	</tr>

<?php 		
		if(isset($_REQUEST['id'])){
						
			$cantidad	= $_POST['cantidad'];
			$id      	= $_REQUEST['id'];

			$verproductos = "SELECT * FROM productos JOIN categorias_productos USING (idproducto)
							JOIN categorias USING(idcategoria) WHERE idproducto='$id' LIMIT 1;";
			$resultado = mysqli_query($db,$verproductos);
			
				while ($registro = mysqli_fetch_array($resultado)){
					$identi = $registro['idproducto'];
						$products = '
							<tr>
							<td><img id="imagen" src="../backoffice/'.$registro['ruta'].'" alt="imagen"></img></td>
							<td>'.$registro['idproducto'].'</td>
							<td class="textupper">'.$registro['titulo'].'</td>
							<td class="textupper">'.$registro['descripcion'].'</td>
							<td class="textupper">'.$registro['precio'].'</td>
							<td class="textupper">'.$registro['marca'].'</td>
							<td>'.$cantidad.'</td>
							</tr>
						';
						// $_SESSION['pedido'] = [ ]
						$_SESSION['pedido'][] = $products;
						$_SESSION['id'][] = $identi;
						$_SESSION['can'][] = $cantidad;

				}
							
		}
		

		$db->close();
 ?>
<?php
if(isset($_SESSION['pedido'])){
	for($i=0;$i<count($_SESSION['pedido']);$i++){
		echo $_SESSION['pedido'][$i];
	}
}


	
 ?>
 </table>
 	<button class="btn" ><a href="indexp.php?sec=patines">Seguir pidiendo</a></button>
 	<button class="btn" ><a href="indexp.php?sec=cancelar">Cancelar Pedido</a></button>
	<?php 
		if(!empty($_SESSION['usuariofront']) || !empty($_SESSION['usuario'])){
			?>
			<button class="btn" type="submit">Comprar</button>
			<?php
		}else{
			?>
			<span onclick="showmenu()" class="btn">Tiene que iniciar session para comprar :)</span>
			<?php
		}
	 ?>
  	
 	
</form>

<?php 
	}
	
 ?>