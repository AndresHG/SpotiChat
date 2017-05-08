
<?php

include('config/vars.php');
session_start();

if(isset($_POST['cuerpoSpoty'])) {
  echo "<script type=''>alert('He entrado');</script>";

  include('config/connection.php');
  mysqli_set_charset($db, 'utf8');
  $texto=$_POST['cuerpoSpoty'];
  $sql="SELECT id FROM mensajes";
  $consulta=mysqli_query($db, $sql);
  $id= mysqli_num_rows($consulta) + 1;
  //usamos como emisor el usuario registrado
  $emisor = $_SESSION['username'];
  $asun = 'difundido' . $id;
  //fecha actual
  $fecha = getdate();
  $sql="INSERT INTO mensajes VALUES ('$id', '$asun', '$emisor', null, '$texto', NULL, '$fecha[year]-$fecha[mon]-$fecha[mday]', 0, 0, 0);";
  mysqli_query($db, $sql);
  header("Location:index.php");
} else {
  echo "<script type=''>alert('No he entrado');</script>";
}
 ?>
