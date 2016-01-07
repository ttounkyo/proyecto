<nav >
	<ul class="log">
		<la id="login">
			 <?php 
		        if (isset($_SESSION['usuariofront'])){
		            $nomuser = $_SESSION['usuariofront'];
		            echo "<a href='indexp.php?sec=logout'><span>$nomuser Logout</span></a>";
		        }else if(isset($_SESSION['usuario'])){
		        	$nomuser = $_SESSION['usuario'];
		            echo "<a href='indexp.php?sec=logout'><span>$nomuser Logout</span></a>";
		        }else{

		        	echo "<span onclick='showmenu()'>Login</span>"
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
				if (isset($_SESSION['usuario'])){
					echo "<a href='../backoffice/index.php'>BACK-OFFICE</a>";
			    }else{
			            echo "<a href='indexp.php?sec=registro'>Registrate</a>";
				}
			?>
			
		</la>
		<la><a href="index.php?">Idioma</a></la>
	</ul>
</nav>
<nav>
	<img id="menu" src="./imagenes/menu.png" alt="menu">
	<ul class="nav">
		<a href="indexp.php?sec=patines"><la>Patines</la></a>
		<a href="indexp.php?sec=accesorios"><la>Accesorios</la></a>
		<a href="indexp.php?sec=marca"><la>Marca</la></a>
		<la>Ofertas</la>
		<la>Personaliza</la>
		<la>Carrito</la>
	</ul>
</nav>
