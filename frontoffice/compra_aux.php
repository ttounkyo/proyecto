<style type="text/css">
<!--
table{
    border: 1px solid black;
}
table#listadopro {
   /* font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;*/
    font-size: 7px;
    margin: 45px;
    /* width: 238px; */
    /* text-align: left; */
    border-collapse: collapse;
}

th {
    font-size: 9px;
    font-weight: normal;
    padding: 3px;
    background-color: white;
    border: 2px solid #e3e3e3;
    /* border-bottom: 1px solid #fff; */
    color: black;
}

tr{
	border: 2px solid #e3e3e3;
}

td {
    padding: 8px;
    background-color: white;
    color: #52625A;
    font-size: 10px;
    border: 2px solid #e3e3e3;
}

img#imagen {
    width: 79px;
    height: 73px;
}

-->
</style>
 <!-- <page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm"> -->
    <page>
      <page_header>
          <img src="./imagenes/logo.png" alt="logo">
      </page_header>

    <table id="listadopro">
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


      <page_footer>
           Page footer
      </page_footer>
</page>