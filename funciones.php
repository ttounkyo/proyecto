<?php 
/**
*Función que crea y devuelve un objeto de conexión a la base de datos y chequea el estado de la misma. 
*/
function conectarBD(){ 
        // $server = "localhost";
        // $usuario = "root";
        // $pass = "";
        $BD = "ttounkyo";
        $server = getenv("OPENSHIFT_MYSQL_DB_HOST");
        $usuario = "admin9kDV7Ta";
        $pass = "XnDEf3TQ2a68";
        
        //variable que guarda la conexión de la base de datos
        $conexion = mysqli_connect($server, $usuario, $pass, $BD);
        //devolvemos el objeto de conexión para usarlo en las consultas  
        return $conexion; 
} 
 
/*Desconectar la conexion a la base de datos*/
function desconectarBD($conexion){
        //Cierra la conexión y guarda el estado de la operación en una variable
        $close = mysqli_close($conexion); 
        //devuelve el estado del cierre de conexión
        return $close;         
}
// $db = new mysqli("mysql://$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT/", "admin9kDV7Ta", "XnDEf3TQ2a68", "ttounkyo");
 ?>