<?php 
	$db = new mysqli('db608606955.db.1and1.com', 'dbo608606955', '162534Aa', 'db608606955');
	if($db->connect_errno > 0){
	    die('Imposible conectar [' . $db->connect_error . ']');
	}
 ?>

<table id="listadopro">
	<tr>
	<th>Identificador</th>
	<th>Nombre</th>
	<th>Eliminar</th>
	<th>Modificar</th>
	</tr>

<?php 

		$vercateg = 'SELECT * FROM categorias;';
		$result_vpro = $db->query($vercateg) or die ($db->connect_error. " en la línea ");
		while ($registro = $result_vpro->fetch_array(MYSQLI_BOTH)){
			echo "<tr>";
			echo "<td>".$registro['idcategoria']."</td>";
			echo "<td>".$registro['nombre']."</td>";
			echo "<td>"."<a href='index.php?sec=eliminarctg&id=".$registro['idcategoria']."'><button>Eliminar</button></a></td>";
			echo "<td><a href='index.php?sec=modificarctg&id=".$registro['idcategoria']."&nom=".$registro['nombre']."'><button>Modificar</button></a></td>";
			echo "</tr>";		
		}

		$db->close();

 ?>

 </table>