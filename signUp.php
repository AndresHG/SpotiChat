<!DOCTYPE html>
<html>

<head>
	<title>Register</title>

	  <!--Metadatos-->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--Links-->
  <!-- FavIcon -->
  <link rel="icon" href="img/logos/Icon_Spotify.png" type="image/x-icon"/>
  <!-- CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/signUp.css">
	<link rel="stylesheet" href="css/login2.css">

  <!-- Add icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<?php include('config/vars.php'); ?>
</head>

<body>

<div class="container">
		<div class="card card-container">
				<img id="profile-img" class="profile-img-card" src="img/logos/Icon_Spotify.png" />
				<p id="profile-name" class="profile-name-card"></p>
				<form action="signUp.php" class="form-signin" method="post">
						<span id="reauth-email" class="reauth-email"></span>
						<input name="user" type="text" id="inputEmail" class="form-control" placeholder="User" required autofocus>
						<input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
						<input class="form-control" id="inputPassword2" type="password" name="rep_pass" placeholder="*Repita Contraseña" required>
					 	<input class="form-control" id="inputEdad" type="number" name="nac"  min="0" max="9999" placeholder="*Año Nacimiento" required>
						<p class="select-genero-margenes">Seleccione la categoria: <p>
						<select class="form-control" id="inputGenero" type="text" name="genero" onchange="myFunction()" id="drop" required>
						<?php
							$estilos= array();
							include('config/connection.php');
							mysqli_set_charset($db, 'utf8');

							$sql="SELECT * FROM generos";
						  $consulta=mysqli_query($db, $sql);
						  while ($cat=mysqli_fetch_object($consulta)){
						   	echo "<option> $cat->id </option> ";
						  };
							echo "<option> otro </option> ";
							@mysqli_close($db);
						?>
						<input class="form-control" id="inputGenero2" type="text" name="genero2" id="yourText" disabled /><br><br>
						<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Register</button>
				</form><!-- /form -->
				Ya estas registrado?
				<a href="login.php" class="forgot-password">
						Login
				</a>
		</div><!-- /card-container -->
</div><!-- /container -->

  <?php

 	$procesando=isset($_POST['user'])?$_POST['pass']:null;
	if($procesando!=null){

		include('config/connection.php');
		mysqli_set_charset($db, 'utf8');

		$user=$_POST['user'];
		$pass=md5($_POST['pass']);
		$rep_pass=md5($_POST['rep_pass']);
		$fecha = getdate();
		$edad=$fecha['year'] - $_POST['nac'];
		if($_POST['genero'] == 'otro' and isset($_POST['genero2'])){
			$genero=strtolower($_POST['genero2']);
		}else {
			$genero=strtolower($_POST['genero']);
		}

		$sql="SELECT nick FROM usuarios WHERE nick='$user'";
		$consulta=mysqli_query($db, $sql);

		if(mysqli_num_rows($consulta)!=0){
		 	echo "<script type=''>
			alert('El nombre de usuario ya existe');
			</script>";
		}else{

			if($pass != $rep_pass){
			 	echo "<script type=''>
				alert('Las contraseñas introducidas no coinciden');
				</script>";
			}else{

				$sql="SELECT id FROM generos WHERE id='$genero'";
				$consulta=mysqli_query($db, $sql);

				if (mysqli_num_rows($consulta)==0){
					$sql="INSERT INTO generos VALUES ('$genero');";
	    			mysqli_query($db, $sql);
				};

				$sql="SELECT * FROM grupos WHERE '$edad' <= edad_max and '$edad' >= edad_min and genero = '$genero';";
				$consulta = mysqli_query($db, $sql);

				while($grupo=mysqli_fetch_object($consulta)){
					$sql="INSERT INTO miembros VALUES ('$user', '$grupo->id', -1);";
          mysqli_query($db, $sql);
				}

				$sql="INSERT INTO usuarios VALUES ('$user', '$pass', '$edad', '$genero');";
  			mysqli_query($db, $sql);
				session_start();
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $user;
  			header("Location: index.php");
			};
		};

		@mysqli_close($db);
    };
?>

<script src="js/register.js"></script>

</body>

</html>
