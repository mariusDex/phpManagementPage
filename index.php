<?php session_start(); //mantener sesión (debe ser lo primero ). 
require_once 'controladores/C_Menu.php';
$menuController = new C_Menu();
//var_dump($_SESSION);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="manifest" href="manifest.json"
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Básico</title>
    <script src="librerias/jquery-3.5.1/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="librerias/bootstrap-4.5.2-dist/css/bootstrap.min.css">
    <script src="librerias/bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/index.css">


    <!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <!-- END FONT -->



    <script src="js/app.js"></script>
</head>

<body>


    <!-- =============  PARTE DE LA CABECERA DE LA PÁGINA  ================ -->
    <div class="container-fluid" id="capaPagina">
        <div class="container-fluid" id="capaEncabezadoPagina">

            <div class="row">

                <div class="col-lg-2 col-md-2 d-none d-md-block" style="justify-content: center;">
                    <img src="fotos/logo.jpg" style="height : 6em; margin : 0px" />
                </div>

                <div class="col-lg-8 col-md-8 col-sm-10 d-sx-block" style="text-align:center;margin-top : 16px;margin-bottom : 16px">
                    <p>
                    <h1>Mariusz Broza</h1>
                    </p>
                </div>
                <!--El d-none es para que lo oculte cuando se haga pequeño  -->
                <!-- El d-sm-block es para que lo tome todo como un bloque -->
                <div class="col-lg-2 col-md-2 col-sm-2  d-none d-sm-block text-right">
                    <?php
                    if (isset($_SESSION['usuario'])) {

                        echo  '<br><img src="fotos/logoutIcon.png" style="height : 1.5em">&nbsp&nbsp&nbsp&nbsp';
                        echo  '<a href="logout.php" title="Cerrar sesión">';
                        echo  '<button class="btn btn-outline-warning" style="color : black" >' . $_SESSION['usuario'] . '</button>';
                        echo  '</a>';
                    } else { // no logueado
                        echo  '<br><a href="login.php" title="Inicial sesión">';
                        echo  '<a href="login.php"><button class="btn btn-warning" >Login</button></a>';
                        echo  '</a>';
                    }

                    ?>
                    <!--  <a href="login.php"><button class="btn btn-primary" >Login</button></a>-->
                </div>

            </div>

        </div>
        <!-- ============== NAV BAR ================ -->
        <div class="container-fluid p-0" id="capaMenu">
            <?php
            $searchOption = '';
            if (isset($_SESSION['usuario'])) {
                $searchOption = 'private';
                $menuController->getVistaMenu($searchOption);
            } else {
                $searchOption = 'public';
                $menuController->getVistaMenu($searchOption);
            }

            ?>



        </div>

        <div class="container-fluid capaContenido" id="capaContenido" style="background-color: #FFC107;
                    background-repeat: no-repeat;
                    background-attachment: fixed;">
            Contenido
        </div>


        <script src="pwa.js" async></script>
</body>



</html>