<?php 
	if(isset($_GET['id'])){

			$identificador = $_GET['id'];
			$db = new mysqli('mysql.hostinger.es', 'u121308368_boss', '162534Aa', '	u121308368_ttoun',3306);
			
			if($db->connect_errno > 0){
			    die('Imposible conectar [' . $db->connect_error . ']');
			}

			$query = "SELECT COUNT(*) AS hijos FROM categorias_productos WHERE idcategoria='$identificador';";
			$result = mysqli_query($db,$query);
			$row = mysqli_fetch_array($result);
			
			if($row[0] != 0){
				echo "<h1>Borrar categoria</h1><br>
				<br>No se puede eliminar porque tiene productos dentro.<br><br>
				<a href=\"index.php?sec=producto\">Volver</a>";
			}else{
				$db->query("DELETE FROM categorias WHERE idcategoria='$identificador';");
				$db->close();
				header('location:index.php?sec=categoria');			
			}
	}

 ?>