


<?php
  session_start();
 $procesando=isset($_POST['asunto'])?$_POST['asunto']:null;
 if($procesando!=null){
   //datos introducidos en el form
   $grupo=$grupo = htmlspecialchars($_GET["grupo"]);
   $asun=$_POST['asunto'];
   $texto=$_POST['mensaje'];

 //conectamos con la bd
 $db = @mysqli_connect('localhost','root','','SpotiChat');
 mysqli_set_charset($db, 'utf8');
 //consultamos el id del nuevo mensaje
 $sql="SELECT id FROM mensajes";
 $consulta=mysqli_query($db, $sql);
 $id= mysqli_num_rows($consulta) + 1;
 //usamos como emisor el usuario registrado
 $emisor = $_SESSION['username'];
 //fecha actual
 $fecha = getdate();

 echo "No hay ningun usuario $grupo registrado con ese Nick";

 $sql="INSERT INTO mensajes VALUES ('$id', '$asun', '$emisor', NULL, '$texto', '$grupo', '$fecha[year]-$fecha[mon]-$fecha[mday]', 0, 0, 0);";

 mysqli_query($db, $sql);

 $sql ="UPDATE miembros SET sin_leer = sin_leer +1 WHERE nick != '$actual' and id_grupo = '$grupo';";
 mysqli_query($db, $sql);

 header("Location:leerGrupo.php?grupo=$grupo");


 @mysqli_close($db);
};
?>
