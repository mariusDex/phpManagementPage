<script src="librerias/jquery-3.5.1/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="librerias/bootstrap-4.5.2-dist/css/bootstrap.min.css">
<script src="librerias/bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
<script src="js/menu.js"></script>
<link rel="stylesheet" href="css/menu.css">
<div class="col-lg-2">

<form id='formEditarPermiso<?php echo $datos['id_Permiso'] ?>'>
  <div class="form-group">
    <label for="namePermiso">Nombre permiso</label>
    <input type="text" class="form-control" name="permiso" id="namePermiso" >
    
  </div>
  <div class="form-group">
    <label for="numeroPermiso">Numero permiso</label>
    <input type="text" class="form-control" name="num_Permiso" id="numeroPermiso">
  </div>
  
  <button type="button" onclick="updatePermiso(<?php echo $datos['id_Permiso'] ?>,<?php echo $datos['id_Opcion'] ?>)" class="btn btn-primary btn-sm">Update</button>
  <button type="button" onclick="toggleBloqueActions('CERRAR_EDITAR_PERMISO',<?php echo $datos['id_Permiso'] ?>)" class="btn btn-primary btn-sm">Cancel</button>
</form>


</div>
