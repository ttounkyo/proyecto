<?php 

	if(isset($_REQUEST['id']) && isset($_POST['ctg'])){
		$ctg 	= $_POST['ctg'];
		$id 	= $_REQUEST['id'];
		require_once("../../funciones.php");
 
		$db = conectarBD();
		
		$sql = "UPDATE categorias SET nombre ='$ctg' WHERE idcategoria = '$id';";
		mysqli_query($db,$sql);
		header('location:index.php?sec=categoria');
		desconectarBD($db);
	}

 ?>

 <form class='categoria' action='index.php?sec=modificarctg&id=<?php echo $_REQUEST['id']?>' method='POST'>
	<h1>Modificar Categorias</h1>
	<div>
		<label for="">Id Categoria</label>
		<br>
		<input type="text"disabled value='<?php echo $_REQUEST['id']?>'>
	</div>
	<div>
		<label for="">Nuevo nombre de categoria: </label>
		<br>
		<input type='text' placeholder='<?php echo $_REQUEST['nom']?>' name='ctg' /></div>
	<div >
	<button class="btn" type='submit' name='enviar'>Enviar</button></div>
</form>