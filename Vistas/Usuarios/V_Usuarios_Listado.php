<script src="js/usuarios.js"></script>
<link rel="stylesheet" href="css/index.css">
 <!-- FONT -->
 <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;532&display=swap" rel="stylesheet">
   <!-- END FONT -->
   <br>
   
<h2> Listado de Usuarios</h2><br>


<?php

  //echo json_encode($datos);   ---> para mostrar los datos en  JSON
    ?>
    
    <div class="table-responsive-lg">
    <table id="tablaResultados" class="table tablaBusqueda" >
        <tr style="border-bottom: 2px solid orange;" >
          <th scope="col">Usuario</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido 1</th>
          <th scope="col">E-mail</th>
          <th scope="col">Telefono</th>
          <th scope="col">Activo</th>
          <th scope="col">Sexo</th>
          <th scope="col">Edit</th>
          </tr>
      </thead>
    <?php

    foreach($datos as $key=>$usuario){
        
        ?>
        <tr>
          
          <td>
          <?php echo $usuario["login"]; ?>
          </td>
          
          

          <td>
          <?php echo $usuario["nombre"]; ?>
          </td>
          
          <td>
            <?php echo $usuario["apellido_1"]; ?>
          </td>

          <td>
            <?php echo $usuario["mail"]; ?>
          </td>

          <td>
            <?php echo $usuario["movil"]; ?>
          </td>

          <td>
            <?php if($usuario["activo"] == 'S'){ ?>
                <label class="form-switch">
                  <input type="checkbox" id="switchActivo<?php echo $usuario['id_Usuario']; ?>" checked onclick="cambiarActivo(<?php echo $usuario['id_Usuario']; ?>)">
                  <i></i>
                </label>
            <?php }else{ ?>
              <label class="form-switch" >
                  <input type="checkbox" id="switchActivo<?php echo $usuario['id_Usuario']; ?>" unchecked onclick="cambiarActivo(<?php echo $usuario['id_Usuario']; ?>)">
                  <i></i>
                </label>
            <?php } ?>    
          </td>

          <td>
            <?php echo $usuario["sexo"]; ?>
          </td>

          <td>
            <button id="editButton<?php echo $usuario['id_Usuario']; ?>"  class="btn btn-warning" onclick="toggleDisplay('EDIT', <?php echo $usuario['id_Usuario']; ?>)">EDIT</button>
          </td>

        </tr>

        

         


       

        <?php
    }



 

?>

      </table>
      </div>


     


      