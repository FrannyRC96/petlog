<?php 

//Este es un trycatch para evitar bugs y donde pasa todo
try{
   //Aquí esta la sentencia de la libreria pdo, que conecta a la base de datos
$base=new PDO("mysql:host=localhost; dbname=petlog", "root", "");

//Esta madre le da los atributos de pdo por si falla
$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//aquí se construye la sentencia SQL que agarra de la tabla usuarios
$sql = "SELECT * FROM usuarios WHERE correo= :email AND contras= :contra";

//esta variable es para usar la sentencia
$resultado=$base->prepare($sql);

//estas variables son las que agarran los datos de los inputs
$mail=htmlentities(addslashes($_POST["email"]));
$contra=htmlentities(addslashes($_POST["contra"]));

//Aqui se comparan los datos obtenidos de la base de datos con los de los inputs 
$resultado->bindValue(":email", $mail);
$resultado->bindValue(":contra", $contra);

//Y aquí ejecuta los resultados
$resultado->execute();

//Este es un arreglo que busca el resultao con las columnas que hay en la base de datos para asegurarse que
//existan
$numero_registro=$resultado->rowCount();

//Esta condicinal hace la comparación de si hay o no resultado, si no hay es un 0 y si hay es 1 o 2 o milochomilconcienmil
if($numero_registro > 0){
  //Aquí te manda a la pagina welcom en caso que no sea 0
  header("location: home.html");
}else{
   //Aquí te aplica el Izanami y no te deja pasar o porque no esta correcto un dato o porque no existe en la base de datos
  
   echo "Usuario no existe";
}

//En caso de que todo haya valido queso, principalmente la conexión, pos aquí te manda error
}catch(Exception $e){
die("Error: " . $e->getMessage());
}
//Y ya es toda wey
?>

