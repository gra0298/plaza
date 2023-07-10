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
      <input type="submit" name="ver_registros" value="Ver Registros">
      <input type="submit" name="generar_pdf" value="generar_pdf">
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
?>
<?php 
if (isset($_POST['ver_registros'])) {
   $consultarDatos = "SELECT * FROM usuarios";
   $resultados = mysqli_query($enlace, $consultarDatos);

   if (mysqli_num_rows($resultados) > 0) {
      while ($fila = mysqli_fetch_assoc($resultados)) {
         echo "ID: " . $fila['id'] . "<br>";
         echo "Nombre: " . $fila['nombre'] . "<br>";
         echo "Correo: " . $fila['email'] . "<br>";
         echo "Contraseña: " . $fila['contraseña'] . "<br><br>";
      }
   } else {
      echo "No hay registros en la base de datos.";
   }
}
?>
<?php
require_once('tcpdf/tcpdf.php');

$servidor="localhost";
$usuario="root";
$clave="";
$bd="plaza";

$enlace = mysqli_connect($servidor, $usuario, $clave, $bd);
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
      <input type="submit" name="ver_registros" value="Ver Registros">
      <input type="submit" name="generar_pdf" value="generar_pdf">
   </form>
</body>
</html>

<?php 
// Resto del código
?>

<?php
if (isset($_POST['generar_pdf'])) {
   // Crea un nuevo objeto TCPDF
   $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

   // Establece el título del documento PDF
   $pdf->SetTitle('Registros de Usuarios');

   // Agrega una nueva página al PDF
   $pdf->AddPage();

   // Configura la fuente y el tamaño del texto
   $pdf->SetFont('helvetica', '', 12);

   // Obtiene los registros de la base de datos
   $consultarDatos = "SELECT * FROM usuarios";
   $resultados = mysqli_query($enlace, $consultarDatos);

   if (mysqli_num_rows($resultados) > 0) {
      while ($fila = mysqli_fetch_assoc($resultados)) {
         // Agrega los datos de cada registro al PDF
         $pdf->Cell(0, 10, 'ID: ' . $fila['id'], 0, 1);
         $pdf->Cell(0, 10, 'Nombre: ' . $fila['nombre'], 0, 1);
         $pdf->Cell(0, 10, 'Correo: ' . $fila['email'], 0, 1);
         $pdf->Cell(0, 10, 'Contraseña: ' . $fila['contraseña'], 0, 1);
         $pdf->Ln(); // Agrega un salto de línea
      }
   } else {
      $pdf->Cell(0, 10, 'No hay registros en la base de datos.', 0, 1);
   }

   // Genera el PDF y lo muestra en el navegador para descargarlo
   ob_end_clean(); // Limpia cualquier salida previa
   $pdf->Output('registros_usuarios.pdf', 'D');
}
?>


