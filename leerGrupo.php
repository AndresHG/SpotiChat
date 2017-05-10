
<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title><?php echo htmlspecialchars($_GET["grupo"]); ?></title>



  <!--Metadatos-->
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!--Links-->
  <!-- FavIcon -->
  <link rel="icon" href="img/logos/Icon_Spotify.png" type="image/x-icon"/>
  <!-- CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/inicio.css">
  <link rel="stylesheet" href="css/listaPartidos.css">
  <link rel="stylesheet" href="css/mensajes.css">

  <!-- Add icon library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <?php include('config/vars.php'); ?>
</head>
  <body>

<!-- <header>
  <nav id = 'nav' class="navbar navbar-default navbar-fixed-top topnav"  >
    <div class="container">
      <a href="index.php"><img id = "logo" src="img/logos/logo_SpotiChat.png" alt="Logo SpotiChat"> </a>
      <div class="dropdown alertas-menu">
          <button class="btn btn-secondary dropdown-toggle notifications" type="button" onclick="changeCompartir('compartir')"  data-toggle="dropdown">
            <span class="glyphicon glyphicon-leaf hidden-xs hidden-sm"> Redactar</span>
            <span class="hidden-md hidden-lg glyphicon glyphicon-leaf"></span>
          </button>
      </div>
    </div>
  </nav>
</header> -->

<header>
  <nav id = 'nav' class="navbar navbar-default navbar-fixed-top topnav"  >
    <div class="container">
      <div class="" style="float:left;">
        <a href="index.php"><img id = "logo" src="img/logos/logo_SpotiChat.png" alt="Logo SpotiChat" class="img-responsive"> </a>
      </div>

      <div class="nav-header hidden-xs hidden-sm" style="float:left">
        <ul class="nav navbar-nav">
          <li><a href="index.php">
          <i class="glyphicon glyphicon-home"></i>
          Home </a></li>
          <?php
          include('config/connection.php');
          mysqli_set_charset($db, 'utf8');
          $actual = $_SESSION['username'];

          echo "<li><a href='grupos.php'>
          <i class='glyphicon glyphicon-send'></i>";
          $sql="SELECT *  FROM miembros WHERE nick = '$actual' and sin_leer != 0";
          $consulta=mysqli_query($db, $sql);
          $nuevos = mysqli_num_rows($consulta);
          if ($nuevos==0){
            echo "  Grupos </a></li>";
          }else{
              echo "  Grupos <span class='badge'>$nuevos</span></a></li>";
          }

          echo "<li><a href='mensajes.php'>
          <i class='glyphicon glyphicon-envelope'></i>";

            $sql="SELECT *  FROM mensajes
            WHERE receptor = '$actual' and borrado_receptor is false and leido is false";
            $consulta=mysqli_query($db, $sql);
            $nuevos = mysqli_num_rows($consulta);
            if ($nuevos==0){
              echo "  Mensajes</a></li>";
            }else{
                echo "  Mensajes <span class='badge'>$nuevos</span></a></li>";
            }
            if($_SESSION['username'] =='admin'){
              echo "<li><a href='crearGrupo.php'>
              <i class='glyphicon glyphicon-edit'></i>
              Crear Grupo </a></li>";
            }
           ?>
        </ul>
      </div>

      <div class="dropdown alertas-menu">
          <button class="btn btn-secondary dropdown-toggle notifications" type="button" onclick="changeCompartir('compartir')"  data-toggle="dropdown">
            <span class="glyphicon glyphicon-leaf hidden-xs hidden-sm"> Redactar</span>
            <span class="hidden-md hidden-lg glyphicon glyphicon-leaf"></span>
          </button>
      </div>
    </div>
  </nav>
</header>


<div class="container  profile-container">
    <div class="row profile">
		<div class="col-xs-12 col-sm-12 col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="img/iconos/huevo.png" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<?php
          $user = $_SESSION['username'];
          echo "<div class='profile-usertitle-name'>
						$user <div class='txtcls' id='anvent'>&nbsp;</div>
					</div>";
           ?>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
        <form class="" action="" method="post">
          <div class="profile-userbuttons">
  					<button onclick="window.location.href='miPerfil.php'" type="button" class="btn btn-success btn-sm">Mi perfil</button>
            <?php
              echo "<input type='submit' class='btn btn-danger btn-sm' name='logout' value='Logout' />";

              if(isset($_POST['logout'])) {
                session_unset();
                session_destroy();
                header("Location:login.php");
              };
             ?>
  				</div>
        </form>
        <div class="hidden-xs hidden-sm">
          <br>
        </div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu hidden-md hidden-lg">
					<ul class="nav">
            <li>
              <a href="index.php">
              <i class="glyphicon glyphicon-home"></i>
              Home </a></li>
              <?php
              include('config/connection.php');
              mysqli_set_charset($db, 'utf8');
              $actual = $_SESSION['username'];

              echo "<li><a href='grupos.php'>
              <i class='glyphicon glyphicon-send'></i>";
              $sql="SELECT *  FROM miembros WHERE nick = '$actual' and sin_leer != 0";
              $consulta=mysqli_query($db, $sql);
              $nuevos = mysqli_num_rows($consulta);
              if ($nuevos==0){
                echo "Grupos </a></li>";
              }else{
                  echo "Grupos <span class='badge'>$nuevos</span></a></li>";
              }

              echo "<li><a href='mensajes.php'>
              <i class='glyphicon glyphicon-envelope'></i>";

                $sql="SELECT *  FROM mensajes
                WHERE receptor = '$actual' and borrado_receptor is false and leido is false";
                $consulta=mysqli_query($db, $sql);
                $nuevos = mysqli_num_rows($consulta);
                if ($nuevos==0){
                  echo "Mensajes</a></li>";
                }else{
                    echo "Mensajes <span class='badge'>$nuevos</span></a></li>";
                }
                if($_SESSION['username'] =='admin'){
                  echo "<li><a href='crearGrupo.php'>
                  <i class='glyphicon glyphicon-edit'></i>
                  Crear Grupo </a></li>";
                }
               ?>

					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-9">
      <div class="profile-content ">

        <?php

      	include('config/connection.php');
        mysqli_set_charset($db, 'utf8');
        $actual = $_SESSION['username'];
        $grupo = htmlspecialchars($_GET["grupo"]);

        $sql="SELECT * , DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM mensajes WHERE grupo = '$grupo' and borrado_receptor is false ORDER BY fecha, id";
    		$consulta=mysqli_query($db, $sql);

    		if (mysqli_num_rows($consulta)==0){

    		 	echo ' <br/><br/> No hay mensajes difundidos disponibles <br/><br/>';
    		}else{
          while ($mensajes=mysqli_fetch_object($consulta)){
            $rand = rand(1, 5);
            $imgSelected = 'perfil' . $rand;
            echo "<div class='panel panel-default'>
              <div class='panel-heading'>
               <div class='panel-title'>
                 <a>";
                 if($mensajes->leido == false){
                   echo "<div class='row blue-text'>";
                 }else{
                   echo "<div class='row'>";
                 }
                     echo "<div class='col-xs-2 col-md-2 profile-userpic sin-padding-right'><img src='img/iconos/$imgSelected.png' class='img-responsive perfil-mensaje' alt=''></div>
                     <div class='col-xs-4 col-md-3 texto-centrado'>$mensajes->emisor</div>
                     <div class='hidden-xs hidden-sm col-md-5 texto-centrado'>$mensajes->asunto</div>
                     <div class='col-xs-6 col-md-2 texto-centrado'>$mensajes->fecha</div>
                 </div>
                 </a>
               </div>
              </div>
              <div>";
              echo "<div class='panel-body back-white'>
                 <p> $mensajes->texto </p>
                 <br>
               </div>
              </div>
              </div>";
          };
        }
        $sql_leidos="UPDATE mensajes SET leido = true where grupo = '$grupo' and borrado_receptor is false;";
        mysqli_query($db, $sql_leidos);
        $sql_leidos="UPDATE miembros SET sin_leer = 0 where id_grupo = '$grupo' and  nick = '$actual';";
        mysqli_query($db, $sql_leidos);
        echo "
          <form class='container-fluid' action='enviarMensajeGrupal.php?grupo=$grupo' method='post'>
            <p class='nuevo-mensaje'><b>Nuevo mensaje</b></p>
            <textarea name='receptor' class='form-control alto-correo-nuevo' placeholder='Destinatario' rows='8' cols='80' required='' disabled>$grupo"; ?></textarea>
            <textarea name="asunto" class="form-control alto-correo-nuevo" placeholder='Asunto' rows="8" cols="80" required=""></textarea>
            <textarea name="mensaje" class="alto-formulario form-control" placeholder='Cuerpo del mensaje...' rows="8" cols="80"></textarea>
            <br>
            <button type="submit" class="btn btn-success">Enviar</button>
            <br><br>
          </form>

      </div>
    </div>
          <!-- caontainer-fluid profile-content -->
  </div>


          <!-- profile-content -->
        </div>
        <!-- col-md-9 profile-content -->

<div  id = "compartir" class="container backgroundFormulario">
    <div class="formulario formulario-container animateFormulario">
      <div class="header-formulario">
        <div class="centrar">
          <a href="index.html"><img class = "logo-formulario" src="img/logos/logo_SpotiChat.png" alt="Logo Pachanga"> </a>
        </div>
              <span onclick="changeCompartir('compartir')" class="closeFormulario" title="Close">&times;</span>
      </div>

      <div class="container-fluid alto-formulario">
        <br>

        <form action='enviarSpoty.php' method="post">
            <div class="container-fluid">
              <textarea type="text" class="alto-formulario form-control" name="cuerpoSpoty" placeholder="Redacte su Spoty" name="" value=""></textarea>
            </div>

            <center>
              <button onclick="changeCompartir('compartir')" type="button" class="btn-formulario cancelbtn">Cancel</button>
              <button onclick="myReload(this)" type="submit" name='enviarSpoty' class="btn-formulario sendbtn"> Enviar </button>
            </center>
        </form>
      <!-- formulario-container -->
      </div>
    <!-- login formulario-container -->
    </div>
<!-- container -->
</div>
    <!-- ******************************************footer******************************************-->
    <footer >
          <br><br>
          <div class="container">
            <div class="row">
              <div class="col-sm-4">
                 <div class = "center"><b>Join us</b> </div>
                <hr>
                <a href="#">Registrarse</a>
                <br>
                <a href="#">Iniciar Sesión</a>
              </div>
              <div class="col-sm-4">
                 <div class = "center"><b>Sobre Pachanga</b> </div>
                <hr>
                <a href="info.html">¿Qué es Pachanga?</a>
                <br>
                Preguntas Frecuentes
                <br>
                Aviso Legal
              </div>

              <div class="col-sm-4">
                 <div class = "center"><b>¿Quiénes somos?</b> </div>
                <hr>
                <a href="info.html#miembros">Sobre Nosotros</a>
                <br>
                <a href="info.html#contacto">Contacto</a>
                <br><br>
                <a href="#" class="fa fa-facebook"></a> &nbsp;
                <a href="#" class="fa fa-twitter"></a> &nbsp;

              </div>

            <!-- row -->
            </div>
          </div>




          <br><br><br><br><br><br>
        </footer>
      <!--*********************************JAVASCRIPT*********************************-->

      <!-- jQuery -->
      <script src="js/jquery.js"></script>

      <!-- Bootstrap Core JavaScript -->
      <script src="js/bootstrap.js"></script>
      <script src="js/compartir.js"></script>
      <script src="js/datepicker.js"></script>

      <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>



    </body>
</html>
