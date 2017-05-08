
<?php
session_start();
if(!isset($_SESSION['username']) or $_SESSION['username'] != 'admin'){
    header('location:login.php');
}
 ?>

 <!DOCTYPE html>
 <html>

 <head>
 	<title>Crear Grupo</title>

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

 	<form action="crearGrupo.php" method="post">

 	 	<input class="cuadro" type="text" name="grupo" placeholder="*Nombre del grupo" required><br> <br>
 	 	<input class="cuadro" type="text" name="min_edad" placeholder="*Edad minima" required><br> <br>
 	 	<input class="cuadro" type="text" name="max_edad" placeholder="*Edad máxima" required><br> <br>
 		<p>Seleccione la categoria<p>
 		<select class="cuadro" type="text" name="genero" onchange="myFunction()" id="drop" required>
 		<?php
 			$estilos= array();
 			$db = @mysqli_connect('mysql.hostinger.es','u908911760_root','lopo23','u908911760_spoty');
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

  	$procesando=isset($_POST['grupo'])?$_POST['min_edad']:null;
 	if($procesando!=null){

 		$db = @mysqli_connect('mysql.hostinger.es','u908911760_root','lopo23','u908911760_spoty');
    mysqli_set_charset($db, 'utf8');

 		$grupo=$_POST['grupo'];
 		$min_edad=$_POST['min_edad'];
 		$max_edad=$_POST['max_edad'];
    if($_POST['genero'] == 'otro' and isset($_POST['genero2'])){
      $genero=strtolower($_POST['genero2']);
    }else {
      $genero=strtolower($_POST['genero']);
    }

 		$sql="SELECT id FROM grupos WHERE id='$grupo'";
 		$consulta=mysqli_query($db, $sql);

 		if(mysqli_num_rows($consulta)!=0){
 		 	echo "<script type=''>
 			alert('El grupo ya existe');
 			</script>";
 		}else{

 			if($min_edad > $max_edad){
 			 	echo "<script type=''>
 				alert('Las edades estan mal');
 				</script>";
 			}else{

 				$sql="SELECT id FROM generos WHERE id='$genero'";
 				$consulta=mysqli_query($db, $sql);

 				if (mysqli_num_rows($consulta)==0){
 					$sql="INSERT INTO generos VALUES ('$genero');";
 	    			mysqli_query($db, $sql);
 				};

 				$sql="INSERT INTO grupos VALUES ('$grupo', '$min_edad', '$max_edad', '$genero');";
 	  		mysqli_query($db, $sql);
        $sql="SELECT nick FROM usuarios WHERE edad <= '$max_edad' and edad >= '$min_edad' and musica = '$genero'";
        $consulta = mysqli_query($db, $sql);
        while ($usuario=mysqli_fetch_object($consulta)){
          $sql="INSERT INTO miembros VALUES ('$usuario->nick', '$grupo', -1);";
          mysqli_query($db, $sql);
        }

        header('Location:index.php');
 			};
 		};

 		@mysqli_close($db);
     };
 ?>

 <script src="js/register.js"></script>

 </body>

 </html>
