<!DOCTYPE html>
<html>

<head>
	<title>Login</title>

	  <!--Metadatos-->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--Links-->
  <!-- FavIcon -->
  <link rel="icon" href="img/logos/Icon_Spotify.png" type="image/x-icon"/>
  <!-- CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
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
          <form action="login.php" class="form-signin" method="post">
              <span id="reauth-email" class="reauth-email"></span>
              <input name="user" type="text" id="inputEmail" class="form-control" placeholder="User" required autofocus>
              <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
              <div id="remember" class="checkbox">
                  <label>
                      <input type="checkbox" value="remember-me"> Remember me
                  </label>
              </div>
              <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Entrar</button>
          </form><!-- /form -->
					No estas registrado?
          <a href="signUp.php" class="forgot-password">
              Regístrate
          </a>
      </div><!-- /card-container -->
  </div><!-- /container -->

  <?php
 	$procesando=isset($_POST['user'])?$_POST['pass']:null;
	if($procesando!=null){

		$usuarios=array();
		$user=$_POST['user'];
		$pass=md5($_POST['pass']);

		include('config/connection.php');

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
