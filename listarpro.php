<?php 
	$db = new mysqli('localhost', 'root', '', 'ttounkyo');
	if($db->connect_errno > 0){
	    die('Imposible conectar [' . $db->connect_error . ']');
	}
 ?>

<table id="listadopro">
	<tr>
	<th>Identificador</th>
	<th>Titulo</th>
	<th>Descripcion</th>
	<th>Precio</th>
	<th>Marca</th>
	<th>Imagen</th>
	<th>Creado</th>
	<th>Eliminar</th>
	<th>Modificar</th>
	</tr>

<?php 

		$verproductos = 'SELECT * FROM productos;';
		$result_vpro = $db->query($verproductos) or die ($db->connect_error. " en la línea ");
		while ($registro = $result_vpro->fetch_array(MYSQLI_BOTH)){
			$id = $registro['idproducto'];
			echo "<tr>";
			echo "<td>".$id."</td>";
			echo "<td>".$registro['titulo']."</td>";
			echo "<td>".$registro['descripcion']."</td>";
			echo "<td>".$registro['precio']."</td>";
			echo "<td>".$registro['marca']."</td>";
			echo "<td><img id='imagen' src='".$registro['ruta']."'alt='imagen'></img></td>";
			echo "<td>".$registro['createdAt']."</td>";
			echo "<td>"."<button><a href='index.php?sec=eliminarpro&n=".$id."'>Eliminar</a></button>"."</td>";
			echo "<td><button><a href='index.php?sec=modificarpro&n=".$id."&t=".$registro['titulo']."&p=".$registro['precio']."&d=".$registro['descripcion']."&img=".$registro['ruta']."'>Modificar</a></button></td>";
			echo "</tr>";		
		}

		$db->close();

 ?>

 </table>