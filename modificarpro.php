<?php 
	// Comprovar que no sea vacio.
	if(isset($_POST['id']) || isset($_REQUEST['titulo']) || isset($_REQUEST['precio']) || isset($_REQUEST['descripcion'])){

		// Conectarme a la base de datos.
		$db = new mysqli('localhost','root','','ttounkyo' , 3306);
		if($db->connect_errno > 0 ){
			die ('Imposible conectar [ '. $db->connect_error . ' ]');
		}

		// Asignar valor a las variables.
		$id = $_REQUEST['id'];
		$titulo = $_REQUEST['titulo'];
		$precio = $_REQUEST['precio'];
		$desc 	= $_REQUEST['descripcion'];
	
		$target_dir = "img_products/".$id."/";
		$target_file = $target_dir. basename($_FILES["fileToUpload"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
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
		if(file_exists($target_file) && empty($values)) {
			echo "Imagen ya existe";
			$uploadOk = 0;
		}else{
			$carpeta = ("img_products/".$id);
				foreach(glob($carpeta . "/*") as $archivos_carpeta){
				           unlink($archivos_carpeta);       
				}
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			       echo "El archivo ha sido ". basename( $_FILES["fileToUpload"]["name"]). " cargado.";
			      // header('location:index.php?sec=servicios');
	   		}else {echo "<b>Error de pujada</b><br>.";}
		}

		// Hacer una actualización a la base de datos.
		$query = "UPDATE productos SET  titulo='$titulo' precio='$precio',descripcion='$desc', ruta='$target_file' WHERE idproducto='$id';";

		// Comprobar que la query sea correcta.
		if ($db->query($query) === TRUE) {
		    echo "Record updated successfully";
		    //header('location:index.php?sec=servicios');
		} else {
		    echo "Error updating record: " . $db->error;
		}
		$db->close();
	}

/*<input type="hidden" name="n" value="<?php echo $_REQUEST['n']?>"> 
*/	
 ?>	
<h2>Modificar Productos</h2>
<!-- Enviar la variable que nos ha pasado servicios para tratarla en el php -->
<form action='index.php?sec=modificarpro&img=<?php echo $_REQUEST['img']?>' method='POST' enctype="multipart/form-data">
	<label for="nomp">ID: </label><br>
	<input type="text" name='id' value="<?php echo $_REQUEST['n']?>" readonly="readonly" style="background:#888;"><br>
	<label for="">New Titulo</label><br>
	<input type="text" name'titulo' value="<?php echo $_REQUEST['t']?>"><br>
	<label for="preciop">New Precio: </label><br>
	<input type="text" name="precio" value="<?php echo $_REQUEST['p']?>"><br>
	<label for="descripcionp">New Descripcion: </label><br>
	<input type="text" name="descripcion" value="<?php echo $_REQUEST['d']?>"><br>
	Selecciona nueva imagen para subir:<br>
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    <input type="submit" value="Añadir" name="añadir">
</form>