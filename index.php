<?php
   $servidor="localhost";
   $usuario="root";
   $clave="";
   $bd="plaza";

   $enlace = mysqli_connect( $servidor,$usuario,$clave,$bd);

   
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Formulario</title>
</head>
<body>
   <form action="#" method="post" name="ejemplo">
      <input type="text" name="nombre" placeholder="Nombre">
      <input type="email" name="correo" placeholder="Correo">
      <input type="text" name="contraseña" placeholder="Contraseña">
      
      <input type="submit" name="registro">
      <input type="reset">
   </form>
   
   
</body>
</html>

<?php 
if(isset($_POST['registro'])){

   $nombre= $_POST ['nombre'];
   $correo= $_POST ['correo'];
   $contraseña= $_POST ['contraseña'];

   $insertarDatos = "INSERT INTO usuarios VALUES('','$nombre','$correo','$contraseña')";
   $ejecutarInsertar = mysqli_query( $enlace,$insertarDatos);
}

if (!$ejecutarInsertar) {
   echo "Error al insertar los datos: " . mysqli_error($enlace);
}


?>