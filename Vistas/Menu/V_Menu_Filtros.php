<script src="librerias/jquery-3.5.1/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="librerias/bootstrap-4.5.2-dist/css/bootstrap.min.css">
<script src="librerias/bootstrap-4.5.2-dist/js/bootstrap.min.js"></script> 
<script src="js/app.js"></script>
<script src="js/menu.js"></script>
<br>

<h3 style="border-bottom:1px solid black ;">Mantenimiento : Menú y permisos</h3>


<label for="selectRole" >Roles</label> 
<select onchange="verifySelection()" id="selectRole" class="form-control col-lg-2" aria-label="Default select example">
<option value="-1" selected>Select role</option>
<?php foreach ($datos['roles'] as $key => $rol) {?>
  <option value="<?php echo $rol['id_Rol']; ?>"><?php echo $rol['rol'] ?></option>
<?php } ?>
</select>

 
<br>

<label for="selectRole">Users</label> 
<select onchange="verifySelection()" id="selectUser" class="form-control col-lg-2" aria-label="Default select example">
<option value="-1" selected>Select user</option>
<?php foreach ($datos['usuarios'] as $key => $user) {?>
  <option value="<?php echo $user['id_Usuario']; ?>"><?php echo $user['login'] ?></option>
<?php } ?>
</select>


<br>
<div id="msgRoleManage" style="color: red;margin-bottom: 5px ;display:none"></div>


<div id="botonesManageRole" style="display: none">
    <button type="button" class="btn btn-danger btn-sm" onclick="manageUserRole('ASSIGN')">Assign role</button>
    <button type="button" class="btn btn-info btn-sm" onclick="manageUserRole('REVOKE')">Revoke role</button>
    <br>
</div>

<br>


    

<div id="divRoles" style="display:none"></div>
<div id="divUsuarios" style="display:none"></div>


<button class="btn btn-info" onclick="buscarMantenimientoMenu()">Buscar</button>
<br>
<br>
<div id="capaResultadosBusquedaMenu" class="container-fluid"></div>