<script src="librerias/jquery-3.5.1/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="librerias/bootstrap-4.5.2-dist/css/bootstrap.min.css">
<script src="librerias/bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
<script src="js/menu.js"></script>
<link rel="stylesheet" href="css/menu.css">

 
 
<?php foreach($datos as $key => $registro){ ?>
 

  <button style="margin-bottom:2px" type="button" id="<?php echo $registro['id_Permiso']; ?>" class="btn btn-info btn-sm"><?php echo $registro['permiso']  ?></button>
  <img src="fotos/remove.png" style="cursor:pointer;" onclick="removePermiso(<?php echo $registro['id_Permiso']; ?>,<?php echo $registro['id_Opcion'] ?>);" />
  <img onclick="toggleBloqueActions('ABRIR_EDITAR_PERMISO',<?php echo $registro['id_Permiso'] ?>,<?php echo $registro['id_Opcion'] ?>)" src="fotos/edit.png" />
  <div style="display:none" id="editarPermiso<?php echo $registro['id_Permiso']; ?>"></div>
  
  <br>
<?php } ?>
    <br>
  <button  type="button" class="btn btn-secondary btn-sm" onclick="toggleBloqueActions('ABRIR_ADD_PERMISO',<?php echo $registro['id_Opcion'] ?>)"  style="margin-bottom:2px;">NEW</button>
  <button  type="button" class="btn btn-danger btn-sm" onclick="toggleBloqueActions('CERRAR_PERMISOS', <?php echo $registro['id_Opcion']; ?>)">CERRAR</button>

  <div class="col-lg-2" id="insertarPermisoDiv<?php echo $registro['id_Opcion'] ?>"></div>
  
