<a href="index.php"><img id="logo" src="imagenes/logo.png" alt="logo"></a>
<nav >
	<ul class="log">
		<la id="login">
			 <?php 
		        if (isset($_SESSION['usuariofront'])){
		            $nomuser = $_SESSION['usuariofront'];
		            echo "<a href='index.php?sec=logout'><span>$nomuser Logout</span></a>";
		        }else if(isset($_SESSION['usuario'])){
		        	$nomuser = $_SESSION['usuario'];
		            echo "<a href='../backoffice/index.php?sec=logout'><span>$nomuser Logout</span></a>";
		        }else{

		        	echo "<span onclick=showmenu()>Login</span>"
		     ?>
		     		
		            <div id="menulog">
						<form action='../backoffice/login.php' method='POST'>
							<label>Usuario</label><br><input type='text' name='nomuser'><br>
							<label>Contraseña</label><br><input type='password' name='pass'><br>
							<button class='btn' type='submit' name='enviar'>Enviar</button>
						</form>	
					</div>
			<?php
		        }
		     ?>
		</la>
		<la>
			<?php
				if (isset($_SESSION['usuario']) && !isset($_SESSION['usuariofront'])){
					echo "<a href='../backoffice/index.php'>BACK-OFFICE</a>";

			    }else if(isset($_SESSION['usuariofront']) && !isset($_SESSION['usuario'])){
			    	echo "<a stylesheet='display:none;'></a>";
			    }else if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuariofront'])){
			        echo "<a href='index.php?sec=registro'>Registrate</a>";
				}
			?>
			
		</la>
		<la><a href="#">Idioma</a></la>
	</ul>
</nav>
<nav>
	<img id="menu" onclick="showmenu2()" src="./imagenes/menu.png" alt="menu">
	<ul id="nav">
		<a href="index.php?sec=patines"><la>Patines</la></a>
		<a href="index.php?sec=accesorios"><la>Accesorios</la></a>
		<a href="index.php?sec=marca"><la>Marca</la></a>
		<la>Ofertas</la>
		<la>Personaliza</la>
		<a href="index.php?sec=listapedido"><la>Carrito</la></a>
	</ul>
</nav>
