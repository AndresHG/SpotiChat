
<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bolochat</title>

	  <!--Metadatos-->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--Links-->
  <!-- FavIcon -->
  <link rel="icon" href="img/logos/Icono-Naranja.png" type="image/x-icon"/>
  <!-- CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/crearMensaje.css">

  <!-- Add icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<div class="formulario col-md-8">

	<form action="crearMensaje.php" method="post">

	 	<input class="cuadro" type="text" name="receptor" placeholder="*Enviar a: ('todos' para difundido)" value="<?php echo htmlspecialchars($_GET["receptor"]); ?>" required><br> <br>
	 	<input class="cuadro" type="text" name="asunto" placeholder="*Asunto" value="<?php echo htmlspecialchars($_GET["asunto"]); ?>" required><br> <br>
	 	<input class="cuadro-texto" type="text" name="mensaje" placeholder="Mensaje:" ><br> <br>
	 	<input class="button-mod" type="submit" value="Enviar">
 	</form>
</div>


 <?php

  $procesando=isset($_POST['receptor'])?$_POST['asunto']:null;
  if($procesando!=null){
	 	//datos introducidos en el form
		$recep=$_POST['receptor'];
		$asun=$_POST['asunto'];
		$texto=$_POST['mensaje'];

	//conectamos con la bd
	$db = @mysqli_connect('localhost','root','','SpotiChat');
	//consultamos el id del nuevo mensaje
	$sql="SELECT id FROM mensajes";
	$consulta=mysqli_query($db, $sql);
	$id= mysqli_num_rows($consulta) + 1;
	//usamos como emisor el usuario registrado
	$emisor = $_SESSION['username'];
	//fecha actual
	$fecha = getdate();

	if($recep != 'todos'){
		$sql="INSERT INTO mensajes VALUES ('$id', '$asun', '$emisor', '$recep', '$texto', NULL, '$fecha[year]-$fecha[mon]-$fecha[mday]', 0, 0, 0);";

		mysqli_query($db, $sql);

		$sql="SELECT nick FROM usuarios WHERE nick='$recep'";
		$consulta=mysqli_query($db, $sql);

		if (mysqli_num_rows($consulta)==0){
			echo "<script type=''>
			alert('No hay ningun usuario registrado con ese Nick');
			</script>";
		} else{
			header("Location: home.php");
		};
	}
	else{
		$sql="INSERT INTO mensajes VALUES ('$id', '$asun', '$emisor', null, '$texto', NULL, '$fecha[year]-$fecha[mon]-$fecha[mday]', 0, 0, 0);";
	    mysqli_query($db, $sql);

			header("Location: home.php");
	};

	@mysqli_close($db);
 };
?>

</body>

</html>
