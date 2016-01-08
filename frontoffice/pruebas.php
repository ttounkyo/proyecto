$products .='
						<tr>
							<td><img id="imagen" src="'.$registro['ruta'].'" alt="imagen"></img></td>
							<td>'.$registro['titulo'].'</td>
							<td>'.$registro['descripcion'].'</td>
							<td>'.$registro['precio'].'</td>
							<td>'.$registro['marca'].'</td>
							<td>
								<?php 
								$cantidad = $registro["cantidad"];
								if($cantidad !=0){
									echo "<select name="cantidad">";
									for ($i=1; $i <= $cantidad ; $i++) { 
										echo "<option value="$i">$i</option>";
									}
									echo "</select>";
								}else{
									echo "<h2>No hay productos por ahora</h2>";
								}
								?>
							</td>
						</tr>
					';