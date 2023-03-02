<script src="js/usuarios.js"></script>
<script src="js/app.js"></script>
<link rel="stylesheet" href="css/index.css">



<div id="capaEditPanel"></div>


<br>


<form id="userEditForm" action="#" method="POST">

    <button type="button" class="btn btn-info" onclick="toggleDisplay('BUSCAR',<?php echo $datos['id_Usuario'] ?>)">Volver</button>

    <br>

    <div class="row">
        <div class="col-lg-3">
            <!-- En una pantalla grande (lg) quiero que se usen 12 columnas para este div -->
            <p>
            <h1><?php echo $datos['login']; ?> </h1>
            <h5 style="padding-left: 10px;">Edit panel</h5>
            </p>
        </div>

    </div>




    <div class="col col-lg-6 userEditForm ">


        <div class="row">

            <div class="form-group col-lg-8 col-md-6 ">
                <label for="usuario"> Usuario :</label><br>
                <input type="text" id="loginEdit" name="login" class="form-control usuarioEdit editInput" value="<?php echo $datos['login'] ?>">
                <p style="display : none;margin-top :2px" class="text-danger loginExist error">Este login no está disponible</p>

            </div>

        </div>

        <div class="row">
            <div class="form-group col-lg-8 col-md-6 ">
                <label for="nombre"> Nombre :</label><br>
                <input type="text" name="nombre" class="form-control nombreEdit editInput" value="<?php echo $datos['nombre'] ?>">

            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-8 col-md-6 ">
                <label for="apellido_1"> Apellido 1 :</label><br>
                <input type="text" name="apellido_1" class="form-control apellido_1Edit editInput" value="<?php echo $datos['apellido_1'] ?>">

            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-8 col-md-6 ">
                <label for="mail"> Email :</label><br>
                <input type="text" id="mailEdit" name="mail" class="form-control mailEdit editInput" value="<?php echo $datos['mail'] ?>">
                <p style="display : none;margin-top :2px" class="text-danger mailExist error">Este e-mail ya está registrado</p>

            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-8 col-md-6 ">
                <label for="movil"> Movil :</label><br>
                <input type="text" name="movil" class="form-control movilEdit editInput" value="<?php echo $datos['movil'] ?>">

            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-4 col-md-6 ">
                <label for="sexo">Sexo</label><br>
                <select class="form-control sexoEdit editInput" name="sexo">
                    <option><?php echo $datos['sexo'] ?></option>
                    <?php if ($datos['sexo'] == 'H') {  ?>
                        <option>M</option>
                    <?php } else { ?>
                        <option>H</option>
                    <?php  } ?>
                </select>

            </div>
        </div>
        <br>

        <div class="row">
            <div class="form-group col-lg-8 col-md-6 ">
                <button type="button" class="btn btn-success" onclick="toggleDisplay('SAVE',
                                                                                  <?php echo $datos['id_Usuario'] ?>,
                                                                                  '<?php echo $datos['login']; ?>',
                                                                                  '<?php echo $datos['mail']; ?>');">Guardar</button>
                <button style="float : right" type="button" class="btn btn-danger" onclick="openEditPanel(<?php echo $datos['id_Usuario'] ?>)">Restablecer</button>
            </div>

      




        </div>
        <br>
        <br>

    </div>


</form>