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
  <link rel="stylesheet" href="css/login2.css">

  <!-- Add icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<div class="formulario col-md-3">

	<form action="login.php" method="post">

	 	<input class="cuadro" type="text" name="user" placeholder="Usuario" required><br> <br>
	 	<input class="cuadro" type="text" name="pass" placeholder="Contraseña" required><br> <br>
	 	<input class="button-mod" type="submit" value="Enviar">
 	</form>

</div>

  <?php
 	$procesando=isset($_POST['user'])?$_POST['pass']:null;
	if($procesando!=null){

		$usuarios=array();
		$user=$_POST['user'];
		$pass=$_POST['pass'];

		$db = @mysqli_connect('mysql.hostinger.es','u908911760_root','lopo23','u908911760_spoty');

		if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	
		$sql="SELECT pass FROM usuarios WHERE nick='$user'";
		$consulta=mysqli_query($db, $sql);

		if (mysqli_num_rows($consulta)==0){
		 	echo "<script type=''>
			alert('Usuario incorrecto. Intentelo de nuevo');
			</script>";
		}

		else{

			$users_obj=mysqli_fetch_object($consulta);

			if($users_obj->pass == $pass){

				session_start();
				$_SESSION['loggedin'] = true;
    		$_SESSION['username'] = $user;

    			header("Location: index.php");

			}else{
				echo "<script type=''>
				alert('Contraseña incorrecta. Intentelo de nuevo');
				</script>";
			};
		}

    	@mysqli_close($db);

    };
?>

</body>

</html>
