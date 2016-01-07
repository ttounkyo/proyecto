<ul>
    <li><a href="index.php?sec=home">Home</a></li>
    <li><a href="index.php?sec=altausuario">Alta Usuario</a></li>
    <li>
	     <?php 
	        if (isset($_SESSION['usuario'])){
	            $nomuser = $_SESSION['usuario'];
	            echo "<a href='index.php?sec=logout'><span> $nomuser Logout</span></a>";
	        }else{
	            echo '<a href="index.php?sec=login"><span>Login<span></a>';
	        }
	     ?>
	</li>
    <li><a href="index.php?sec=categoria">Categoria</a></li>
    <li><a href="index.php?sec=producto">Producto</a></li>
    <li><a href="index.php?sec=compra">Compras</a></li>
    <li><a href="index.php?sec=log">Log</a></li>
    <li><a href="../frontoffice/indexp.php">FRONT-OFFICE</a></li>
</ul>