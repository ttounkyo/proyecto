<a href="index.php"><img id="logo" src="imagenes/logo.png" alt="logo"></a>
<div class="login">

<nav>
	<ul class="log">
		<la id="login">
<?php
if (isset($_SESSION['usuariofront'])) {
	$nomuser = $_SESSION['usuariofront'];
	echo "<a href='index.php?sec=logout'><span>$nomuser Logout</span></a>";
} else if (isset($_SESSION['usuario'])) {
	$nomuser = $_SESSION['usuario'];
	echo "<a href='../backoffice/principal/index.php?sec=logout'><span>$nomuser Logout</span></a>";
} else {
	echo "<span onclick=showmenu()>Login</span>";
	?>

	<div id="menulog">
		<form action='../backoffice/usuario/login.php' method='POST'>
			<label>Usuario</label><br><input type='text' name='nomuser'><br>
			<label>Contraseña</label><br><input type='password' name='pass'><br>
			<button class='btn' type='submit' name='enviar'>Enviar</button>
		</form>
		<a class="btn" href="./fb/fbconfig.php">Facebook</a>
	</div>
<?php
}
?>
		</la>
		<la>
<?php
if (isset($_SESSION['usuario']) && !isset($_SESSION['usuariofront'])) {
	echo "<a href='../backoffice/principal/index.php'>BACK-OFFICE</a>";

} else if (isset($_SESSION['usuariofront']) && !isset($_SESSION['usuario'])) {
	echo "<a stylesheet='display:none;'></a>";
} else if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuariofront'])) {
	echo "<a href='index.php?sec=registro'>Registrate</a>";
}
?>
		</la>
		<la><a href="#">Idioma</a></la>
	</ul>


</div>
	<img id="menu" onclick="showmenu2()" src="./imagenes/menu.png" alt="menu">
	<div id="cap">
	<ul class="nav">
		<la><a href="index.php?sec=patines">Patines</a></la>
		<la><a href="index.php?sec=accesorios">Accesorios</a></la>
		<la><a href="index.php?sec=marca">Marca</a></la>
		<la><a href="#">Ofertas</a></la>
		<la><a href="#">Personaliza</a></la>
		<la><a href="index.php?sec=listapedido">Carrito</a></la>
		<la><a>Galeria</a>
			<ul>
				<li><a href="index.php?sec=imagenes">Imagenes</a></li>
				<li><a href="index.php?sec=videos">Videos y sonido</a></li>
			</ul>
		</la>
	</ul>
	</div>
</nav>
