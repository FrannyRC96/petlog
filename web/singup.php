<?php 
//Aquí declaramos las variables que queremos obtener
$mail = $_POST["email"];
$cont = $_POST["contra"];
//Esto es el traicach donde todo pasa
try{
     //Aquí esta la sentencia de la libreria pdo, que conecta a la base de datos
$base=new PDO("mysql:host=localhost; dbname=petlog", "root", "");

//Esta madre le da los atributos de pdo por si falla
$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//Esta variable es la sentencia sql
$sql="INSERT INTO usuarios (correo, contras) VALUES (:email, :contra)";
//Este resultado es igual a la base que obtiene el sql
$resultado=$base->prepare($sql);
//y aquí ejecuta el arreglo que se obtiene de los campos, y los inserta en la tabla
$resultado->execute(array(":email"=>$mail, ":contra"=>$cont));
//Y ps aqui te manda a la pagina de home
header("location: home.html");
//esto es pa cualquier falla de la database
}
catch(Exception $e){
    die("Error: " . $e->getMessage());
}
//y ya es toda wey
?>
