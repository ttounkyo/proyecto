<?php

	if(isset($_GET['n'])){

			$identificador = $_GET['n'];
			echo $identificador."<br>";
			$db = new mysqli('localhost', 'root', '', 'ttounkyo');
			
			if($db->connect_errno > 0){
			    die('Imposible conectar [' . $db->connect_error . ']');
			}

			$query = "SELECT * FROM productos WHERE idproducto='$identificador';";
			$resultado = $db->query($query) or die('Ocurrio un error ejecutando el query [' . $db->error . ']');;


			if($row = $resultado->fetch_array(MYSQLI_BOTH)){
					$db->query("DELETE FROM productos WHERE idproducto='$identificador';");
				
				$carpeta = ("img_products/".$identificador);
				foreach(glob($carpeta . "/*") as $archivos_carpeta){
				           unlink($archivos_carpeta);       
				}
				rmdir($carpeta);					
				header('location:index.php?sec=producto');			
			}else{
					echo "El PRODUCTO no existe en nuestra base de datos";
			}
			
			// $carpeta = glob("img_products/".$identificador."/*");
			// echo $carpeta;
			// unlink($carpeta);
			// rmdir($identificador);
			// function eliminarDir($carpeta){
			//    foreach(glob($carpeta . "/*") as $archivos_carpeta){
			//        echo $archivos_carpeta;

			//        if (is_dir($archivos_carpeta)){
			//            eliminarDir($archivos_carpeta);
			//        }
			//        else{
			//            unlink($archivos_carpeta);
			//        }
			//    }
			//    rmdir($carpeta);
			// }
			//header("location:index.php?sec=servicios");
			// $db->close();

	}
?>