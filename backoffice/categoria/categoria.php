<form class='categoria' action='index.php?sec=categoria' method='POST'>
	<h1>Crear Categorias</h1>
	<div><label for="ctg">Nombre de categoria: </label><br>
	<input type='text' value='' name='ctg' /></div>
	<div ><button class="btn" type='submit' name='enviar'>Enviar</button></div>
</form>

	<?php 
		if(isset($_POST['ctg'])){
			$nom_categ	=	$_POST['ctg'];
			require_once("../../funciones.php");
 
			$db = conectarBD();
			if($db->connect_errno > 0){
			    die('Imposible conectar [' . $db->connect_error . ']');
			}
			
			$query = "INSERT INTO categorias(nombre)
					VALUES ('$nom_categ');";
				
				if($resul = $db->query($query)){
					echo "Categoria añadida";
				}else{
					echo "Categoria ya existe.";
					die ($db->connect_error. " en la línea ");
				}
			desconectarBD($db);
		}
	require_once("listarctg.php");
	?>