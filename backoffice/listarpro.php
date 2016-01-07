
<table id="listadopro">
	<tr>
	<th>Identificador</th>
	<th>Titulo</th>
	<th>Descripcion</th>
	<th>Precio</th>
	<th>Marca</th>
	<th>Imagen</th>
	<th>Cantidad</th>
	<th>Creado</th>
	<th>Categoria</th>
<?php 
	if($_SESSION['rol']== 'administrador'){
		// Para agregar el contenido
 ?>
	<th>Eliminar</th>
	<th>Modificar</th>
<?php 
	}
 ?>
	<th>Seleccionar</th>
	</tr>

<?php 
		
		$verproductos = 'SELECT * FROM productos JOIN categorias_productos USING (idproducto)
						JOIN categorias USING(idcategoria) GROUP BY idproducto';
		$result_vpro = $db->query($verproductos) or die ($db->connect_error. " en la línea ");
		while ($registro = $result_vpro->fetch_array(MYSQLI_BOTH)){
			$id 	= $registro['idproducto'];
			$idcat 	= $registro['idcategoria'];
			$noms 	= $registro['nombre'];
			echo "<tr>";
			echo "<td>".$id."</td>";
			echo "<td>".$registro['titulo']."</td>";
			echo "<td>".$registro['descripcion']."</td>";
			echo "<td>".$registro['precio']."</td>";
			echo "<td>".$registro['marca']."</td>";
			echo "<td><img id='imagen' src='".$registro['ruta']."'alt='imagen'></img></td>";
			echo "<td>".$registro['cantidad']."</td>";
			echo "<td>".$registro['createdAt']."</td>";
			echo "<td>".$registro['nombre']."</td>";
			if($_SESSION['rol']== 'administrador'){
				echo "<td><a href='index.php?sec=eliminarpro&id=".$id."'><button>Eliminar</button></a></td>";
				echo "<td><a href='index.php?sec=modificarpro&cant=".$registro['cantidad']."&ctg=".$idcat."&m=".$registro['marca']."&id=".$id."&t=".$registro['titulo']."&p=".$registro['precio']."&d=".$registro['descripcion']."&img=".$registro['ruta']."'><button>Modificar</button></a></td>";
			}
			// echo "<td><a href='index.php?sec=pedido&id=".$id."'><button>Seleccionar</button></a></td>";
			echo "</tr>";		
		}

		$db->close();

 ?>

 </table>

 <!-- 
 			// Mostrar en las que categorias que esten esos productos.
			$nomctg = "SELECT nombre FROM categorias JOIN categorias_productos  USING(idcategoria) WHERE idproducto='$id';";
			mysqli_query($db,$nomctg);
			$resultado = mysqli_query($db,$verproductos);
			while ($reg = mysqli_fetch_array($resultado)){
				echo $reg['idproducto'];
				echo $reg['idcategoria'];
				echo $reg['nombre'];
			}
  -->