

<?php
  session_start();
 $procesando=isset($_POST['receptor'])?$_POST['asunto']:null;
 if($procesando!=null){
   //datos introducidos en el form
   $recep=$_POST['receptor'];
   $asun=$_POST['asunto'];
   $texto=$_POST['mensaje'];

 //conectamos con la bd
 $db = @mysqli_connect('mysql.hostinger.es','u908911760_root','lopo23','u908911760_spoty');
 mysqli_set_charset($db, 'utf8');
 //consultamos el id del nuevo mensaje
 $sql="SELECT id FROM mensajes";
 $consulta=mysqli_query($db, $sql);
 $id= mysqli_num_rows($consulta) + 1;
 //usamos como emisor el usuario registrado
 $emisor = $_SESSION['username'];
 //fecha actual
 $fecha = getdate();

 $sql="INSERT INTO mensajes VALUES ('$id', '$asun', '$emisor', '$recep', '$texto', NULL, '$fecha[year]-$fecha[mon]-$fecha[mday]', 0, 0, 0);";

 mysqli_query($db, $sql);

 $sql="SELECT nick FROM usuarios WHERE nick='$recep'";
 $consulta=mysqli_query($db, $sql);

 if (mysqli_num_rows($consulta)==0){
   echo "<script type=''>
   alert('No hay ningun usuario registrado con ese Nick');
   </script>";
 } else{
   header("Location:mensajes.php");
 };


 @mysqli_close($db);
};
?>
