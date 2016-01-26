<style type="text/css">
<!--
table{
    border: 1px solid black;
}
table{
    font-size: 12px;
    margin: 45px;
    width: 480px;
    text-align: left;
    border-collapse: collapse;
}

th {
	font-size: 19px;
    font-weight: normal;
    padding: 8px;
    background-color: #C88657;
    border: 2px solid #e3e3e3;
    /* border-bottom: 1px solid #fff; */
    color: #52625A;
}

tr{
	border: 2px solid #e3e3e3;
}

td {
    padding: 8px;
    background-color: #C88657;
    color: #52625A;
    font-size: 21px;
    border: 2px solid #e3e3e3;
}
-->
</style>
 <page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
      <page_header>
          <img src="./imagenes/logo.png" alt="logo">
      </page_header>
      <page_footer>
           Page footer
      </page_footer>

    <table>
<!--         <thead>
            <tr>
                <th>Header 1</th>
                <th>Header 2</th>
            </tr>
        </thead>
        <tbody> -->
        <tr>
		<th>Imagen</th>
		<th>Titulo</th>
		<th>Descripcion</th>
		<th>Precio</th>
		<th>Marca</th>
		<th>Cantidad</th>
		</tr>
<?php

if (isset($_SESSION['carrito'])) {
	foreach ($_SESSION['carrito'] as $key => $value) {
		?>
		<tr>
			<td><img id="imagen" src="../backoffice/<?=$value['ruta']?>" alt="imagen"></td>
			<td class="textupper"><?=$value['titulo']?></td>
			<td class="textupper"><?=$value['descripcion']?></td>
			<td class="textupper"><?=$value['precio']?></td>
			<td class="textupper"><?=$value['marca']?></td>
			<td><?=$value['cantidad']?></td>
		</tr>
		<?php
}
}
?>
       <!--  </tbody>
        <tfoot>
            <tr>
                <th>Footer 1</th>
                <th>Footer 2</th>
            </tr>
        </tfoot> -->
    </table>
 </page>