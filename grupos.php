
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
  <link rel="stylesheet" href="css/home.css">

  <!-- Add icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<?php

	session_start();

	$db = @mysqli_connect('localhost','root','','SpotiChat');

		$actual = $_SESSION['username'];

		$sql="SELECT * , DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM mensajes WHERE receptor is null and grupo is not null and borrado_emisor is false ORDER BY id DESC";
		$consulta=mysqli_query($db, $sql);

		if (mysqli_num_rows($consulta)==0){

		 	echo ' <br/><br/> No hay mensajes difundidos disponibles <br/><br/>';
		}else{
			echo "------------------------------------<br/>";
			echo "Mensajes Difundidos: <br/>";
			echo "------------------------------------ <br/><br/>";

			while ($mensajes=mysqli_fetch_object($consulta)){

				echo "Emisor: $mensajes->emisor -------------------------";
				echo "Receptor: todos ------------------------";
				echo "Fecha: $mensajes->fecha <br/> <br/>";
				echo "Asunto: $mensajes->asunto <br/> <br/>";
				echo "$mensajes->texto <br/><br/><br/>";
				if($mensajes->emisor == $_SESSION['username']){
					$nom = 'buton' . $mensajes->id;
					echo "<form action='' method='post'> <input type='submit' name='$nom' value='borrar' /> </form>";
					if(isset($_POST[$nom])) {
		    		$sql_del="UPDATE mensajes SET borrado_emisor = 1 where id = $mensajes->id;";
						mysqli_query($db, $sql_del);
						header("Location: home.php");
					};
				};
				echo "----------------------------------------------------------------------------------------------------- <br/><br/><br/>";
		};
	};

		echo "<a href='crearMensaje.php?receptor=&asunto=' class='btn btn-info' role='button'>Redactar</a>";

		@mysqli_close($db);
?>

</body>
</html>
