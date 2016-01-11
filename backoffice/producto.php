<?php 
	 
	if($db->connect_errno > 0){
	    die('Imposible conectar [' . $db->connect_error . ']');
	}
 ?>
<form action="index.php?sec=producto" method="POST" enctype="multipart/form-data">		
	<div><label for="">Titulo</label><br><input type="text" name="titulo"></div>
	<div><label for="">Descripcion</label><br><input type="text" name="descripcion"></div>
	<div><label for="">Precio</label><br><input type="text" name="precio"></div>
	<div><label for="">Marca</label><br><input type="text" name="marca"></div>
	<div>
		<label for="">Cantidad</label>
		<br>
		<input type="text" name="cant">
	</div>
	<div><label for="">Categoria</label><br>
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
						echo "<option value='$valor'>$n</option>";
				}
			 ?>
		</select>
	</div>
	<div>Selecciona la imagen que quieres subir:<br>
	    <input type="file" name="fileToUpload" id="fileToUpload"></div><br>
	<div ><button class="btn" type='submit' name='enviar'>Enviar</button></div>
</form>
<?php 
	if(!empty($_POST['titulo']) && isset($_POST['precio']) && isset($_POST['marca'])){

		$titulo 	=	$_POST['titulo'];
		$descrp 	=	$_POST['descripcion'];
		$precio 	=	$_POST['precio'];
		$marca 		=	$_POST['marca'];
		$nomcat 	=	$_POST['cat'];
		$cant 		=	$_POST['cant'];

		$pronou = "INSERT INTO productos(titulo,descripcion,precio,marca,cantidad)
			VALUES ('$titulo','$descrp','$precio','$marca','$cant');";
		mysqli_query($db,$pronou);

		$product = "SELECT idproducto FROM productos WHERE titulo='$titulo' AND marca='$marca';";
		$resul_pro = $db->query($product) or die ($db->connect_error. " en la línea ");
		$id_pro = $resul_pro->fetch_array(MYSQLI_BOTH)['idproducto'];
		
		// $categ = "SELECT idcategoria FROM categorias WHERE nombre='$nomcat';";
		// $resul_categ = $db->query($categ) or die ($db->connect_error. " en la línea ");
		// $id_cat = $resul_categ->fetch_array(MYSQLI_BOTH)['idcategoria'];


		if(!is_dir("img_products/".$id_pro)){ // Miram si el directori ja existeix i si no el cream
			mkdir("img_products/".$id_pro);
		}

			$target_dir = "img_products/".$id_pro."/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			$uploadOk = 1;

			// Mira si es una imatge o no
			if(isset($_POST["submit"])) {
	    			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

	    		if($check !== false) {
	       			 echo "File is an image - " . $check["mime"] . ".";
	      			  $uploadOk = 1;
	    		} else {
	       			 echo "File is not an image.";
	        		$uploadOk = 0;
	    		}
			}

		if (file_exists($target_file)) {
   			 echo "Lo siento ya existe";
    		$uploadOk = 0;
		}
		//Aqui es fa la pujada del arxiu
		if ($uploadOk == 0) {
		    header('location:index.php?sec=producto');
		//Si va tot be, es puja
		}else {
		   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		   	echo "Entra aqui";
		     header('location:index.php?sec=producto');
		   }else {
		   	echo "<br>Error al subir imagen<br>.";
		   }
		}
		// hay que ponerlos en la tabla de media las fotos para poder acceder a ellas y la media query de los productos 
		// pertenecen a otras categorias.
		$pronou = "UPDATE productos SET ruta = '$target_file' WHERE idproducto='$id_pro';";
		mysqli_query($db,$pronou);
		foreach ($nomcat as $value) {
			$catpro = "INSERT INTO categorias_productos(idcategoria,idproducto) VALUES ('$value','$id_pro');";
			mysqli_query($db,$catpro);
		}
		
		$db->close();
	}
	require_once("listarpro.php");
 ?>