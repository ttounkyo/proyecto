 <?php 
	$db = new mysqli('localhost', 'root', '', 'ttounkyo');

 ?>

	<h1>Pedidos</h1>
<table id="listadopro">
	<tr>
	<th>Identificador</th>
	<th>Metodo de pago</th>
	<th>Estado</th>
	<th>Fecha</th>
	<th>User</th>
	</tr>

<?php 
		

		if(isset($_REQUEST['id'])){
			$id = $_REQUEST['id'];
			$verproductos = "SELECT * FROM pedido";
			$resultado = mysqli_query($db,$verproductos);
			
				while ($registro = mysqli_fetch_array($resultado)){
					echo "<tr>";
					echo "<td>".$registro['idpedido']."</td>";
					echo "<td>".$registro['idmetodopago']."</td>";
					echo "<td>".$registro['estado']."</td>";
					echo "<td>".$registro['fecha']."</td>";
					echo "<td>".$registro['username']."</td>";
					echo "</tr>";	
				}
		}
		

		$db->close();

 ?>

 </table>