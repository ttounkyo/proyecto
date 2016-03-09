<style type="text/css">
<!--
 page_header{
    min-height: 150px;
    background-color: #483E3D;
    overflow: hidden;
}
table#listadopro {
   /* font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;*/
    font-size: 7px;
    margin: 45px;
    /* width: 238px; */
    /* text-align: left; */
    border-collapse: collapse;
}
span{
    text-align: center;
}
p{
    text-align: center;
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
    <page>
    <page_header>
          <img src="./imagenes/logo.png" alt="logo">
    </page_header>
      <br><br><br>

    <table id="listadopro">
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
    </table>

    <page_footer>
        <span>© 1996-2015, ttounkyo.com, Inc. o afiliados. Todos los derechos reservados.</span><br>
           <p>
        ¿Necesitas ayuda?<br>
        Localizar o gestionar compras<br>
        Tarifas y políticas de envío<br>
        Devolver o reemplazar productos<br>
        </p>
    </page_footer>
</page>