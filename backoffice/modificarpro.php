<?php 
	$db = new mysqli('mysql.hostinger.es', 'u121308368_boss', '162534Aa', '	u121308368_ttoun');

	// Comprovar que no sea vacio.
	if(isset($_POST['marca']) || isset($_POST['tit']) || isset($_POST['precio']) || isset($_POST['descripcion'])){

		// Conectarme a la base de datos.
		

		// Asignar valor a las variables.
		
		$id 	= $_REQUEST['id'];
		$marca 	= $_POST['marca'];
		$precio = $_POST['precio'];
		$descripcion 	= $_POST['descripcion'];
		$tit 	= $_POST['tit'];
		$cant 	= $_POST['cant'];
		$cat 	= $_POST['cat'];

		$target_dir = "img_products/".$id."/";
		$target_file = $target_dir. basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;

		// Mira si es una imatge o no
		if(isset($_POST["submit"])) {
    			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    		if($check !== false) {
       			 echo "Archivo es una imagen - " . $check["mime"] . ".";
      			  $uploadOk = 1;
    		} else {
       			 echo "Archivo es una imagen";
        		$uploadOk = 0;
    		}
		}

		// miramos si hay umagen
		if(file_exists($target_file)) {
			$target_file = $_REQUEST['img'];
			$uploadOk = 0;
		}else{
			$carpeta = ("img_products/".$id);
				foreach(glob($carpeta . "/*") as $archivos_carpeta){
				           unlink($archivos_carpeta);       
				}
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			       echo "El archivo ha sido ". basename( $_FILES["fileToUpload"]["name"]). " cargado.";
	   		}else {echo "<b>Error de pujada</b><br>.";}
		}

		// Hacer una actualización a la base de datos.
		$update = "UPDATE productos SET  titulo='$tit' ,descripcion='$descripcion',precio='$precio',marca='$marca', ruta='$target_file',cantidad='$cant' WHERE idproducto='$id';";
		mysqli_query($db,$update);
		
		// hacer un insert aqui de categoria producto por si el producto pertenece a otra categoria.
		if($cat != 1){
			$query = "DELETE FROM categorias_productos WHERE idproducto='$id';";
			mysqli_query($db,$query);

			foreach ($cat as $value) {
				$catpro = "INSERT INTO categorias_productos(idcategoria,idproducto) VALUES ('$value','$id');";
				mysqli_query($db,$catpro);
			}
		}
			
		
		header('location:index.php?sec=producto');
	}

 ?>	
<h2>Modificar Productos</h2>
<!-- Enviar la variable que nos ha pasado servicios para tratarla en el php -->
<form action='index.php?sec=modificarpro&id=<?php echo $_REQUEST['id']?>&ctg=<?php echo $_REQUEST['ctg']?>&img=<?php echo $_REQUEST['img']?>' method='POST' enctype="multipart/form-data">
	<label for="nomp">ID: </label><br>
	<input type="text" name='id' disabled value="<?php echo $_REQUEST['id']?>"  style="background:#E4D0D0;"><br>
	<label for="">New Titulo</label><br>
	<input type="text" name="tit" value="<?php echo $_REQUEST['t']?>"><br>
	<label for="preciop">New Precio: </label><br>
	<input type="text" name="precio" value="<?php echo $_REQUEST['p']?>"><br>
	<label for="descripcionp">New Descripcion: </label><br>
	<input type="text" name="descripcion" value="<?php echo $_REQUEST['d']?>"><br>
	<label for="descripcionp">New Marca: </label><br>
	<input type="text" name="marca" value="<?php echo $_REQUEST['m']?>"><br>
	<label>Nueva Cantidad: </label><br>
	<input type="text" name="cant" value="<?php echo $_REQUEST['cant']?>"><br>
	Selecciona nueva imagen para subir:<br>
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    <input type="submit" value="Modificar" name="añadir"><br>
	<div>
	<label for="">Categoria</label><br>
		<select name="cat[]" multiple style="width:100px;border:1px solid #04467E;background-color:#DDFFFF;color:#2D4167;font-size:18px" >
			<?php 
				$query = 'SELECT * FROM categorias;';
				// Comprobar la query
				$resultado = $db->query($query) or die ($db->connect_error. " en la línea ");
				// Mostrar los valores de la tabla productos.
				while ($registro = $resultado->fetch_array(MYSQLI_BOTH)){
						// Tanto con variables o con el mismo registro.
						$valor = $registro['idcategoria'];
						$n = $registro['nombre'];
						echo "<option value='$valor' selected>$n</option>";		
				}
				
	mysqli_close($db);
			 ?>
		</select>
	</div>
</form>
