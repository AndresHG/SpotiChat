<!DOCTYPE html>
<html>

<head>
	<title>SpotyChat</title>

	  <!--Metadatos-->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--Links-->
  <!-- FavIcon -->
  <link rel="icon" href="img/logos/Icono-Naranja.png" type="image/x-icon"/>
  <!-- CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/signUp.css">

  <!-- Add icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<div class="formulario col-md-3">

	<form action="signUp.php" method="post">

	 	<input class="cuadro" type="text" name="user" placeholder="*Usuario" required><br> <br>
	 	<input class="cuadro" type="text" name="pass" placeholder="*Contraseña" required><br> <br>
	 	<input class="cuadro" type="text" name="rep_pass" placeholder="*Repita Contraseña" required><br> <br>
	 	<input class="cuadro" type="number" name="nac"  min="0" max="9999" placeholder="*Año Nacimiento" required><br> <br>
		<p>Seleccione la categoria<p>
		<select class="cuadro" type="text" name="genero" onchange="myFunction()" id="drop" required>
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
		</select><br><br>
		<div class="">
			Si desea utilizar otro genero:
			<input type="checkbox" name="otro_genero" id="yourBox" /><br><br>
		</div>
		<input class="cuadro" type="text" name="genero2" id="yourText" disabled /><br><br>
	 	<input class="button-mod" type="submit" value="Enviar">
 	</form>

</div>

  <?php

 	$procesando=isset($_POST['user'])?$_POST['pass']:null;
	if($procesando!=null){

		include('config/connection.php');
		mysqli_set_charset($db, 'utf8');

		$user=$_POST['user'];
		$pass=$_POST['pass'];
		$rep_pass=$_POST['rep_pass'];
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
