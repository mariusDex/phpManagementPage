<?php session_start(); //mantener sesión (debe ser lo primero ). 

    $login='';
    $pass='';

    
    extract($_POST); // convierte en variables el contenido de POST
    $msj='';

    if($login != '' && $pass != ''){

        //if($usuario != '' && $pass == ''){
            $_SESSION['usuario']= $login;

            header('Location: index.php'); // importante que antes de <?php no haya absolutamente nada porque si no el location no va a funcionar.

        //}else{
         //   $msj='Datos erróneos.';
        //}
    }

?>  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Básico</title>
    <script src="librerias/jquery-3.5.1/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="librerias/bootstrap-4.5.2-dist/css/bootstrap.min.css">
    <script src="librerias/bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>

     <!-- FONT -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;532&display=swap" rel="stylesheet">
   <!-- END FONT -->

    <link rel="stylesheet" href="css/index.css">
    <script src="js/index.js"></script>
    <script src="js/login.js"></script>
</head>
<body background="fotos/loginBackground.jpg" style="background-repeat:no-repeat;">
    <div class="container-fluid p-0 containerLogin ml-0 col-lg-3" id="containerLogin" >

    <div class="col-lg-12 p-0 formLoginDiv">

        <form id="formLogin" action="#"   method="POST" >
            
                <div class="row">
                    <div class="col-lg-12"> <!-- En una pantalla grande (lg) quiero que se usen 12 columnas para este div -->
                        <h2>User Login</h2>
                        <span id=msj style="color: red;"><?php echo $msj; ?></span>
                    </div>
                </div>

                <br>
                <br>
                <br>

                <div class="row">

                    <div class="form-group col-lg-12 col-md-6" >
                        <label for="login" > Usuario :</label><br>
                            <input type="text" id="loginEntry" name="login"
                            class="form-control" placeholder="Nombre Usuario">

                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-lg-12 col-md-6">
                        <label for="pass" > Contraseña :</label><br>
                            <input type="password" id="passEntry" name="pass"
                                class="form-control" placeholder="Contraseña" value="">

                    </div>

                </div>

                <div class="row">
                <div class="col-lg-12">
                    <button type="button" onclick="validar()"
                        class="btn btn-outline-warning">Login</button>
                    
                        <a href="index.php"><button style="float: right;" type="button" 
                        class="btn btn-warning">Back to page</button></a>
                    
                </div> 

                <br>
                <br>
                
                <div class="col-lg-12">
                <p style="display : none; margin-top :2px" class="text-danger invalidLogin">Usuario o contraseña erróneos</p>
                    
                </div> 




                
                </div>

                </div>

                <br>
                    <br>

            

        </form>
        </div>
    </div>
</body>
</html>