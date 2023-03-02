<script src="librerias/jquery-3.5.1/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="librerias/bootstrap-4.5.2-dist/css/bootstrap.min.css">
<script src="librerias/bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
<script src="js/menu.js"></script>
<link rel="stylesheet" href="css/menu.css">

<div class="col-lg-3 border border-primary rounded p-3 bg-success bg-gradient"  >
    <form id="insertMenuForm<?php echo $datos['bloqueID']; ?>">
        <div class="mb-3">
            <label for="optionName" class="form-label">Option name</label>
            <input type="text" class="form-control"  name="optionName" id="optionName" >
        </div>
        <div class="mb-3">
            <label for="method" class="form-label">Method</label>
            <input type="text" class="form-control"  name="method" id="method" >
        </div>

        <div class="mb-3">
            <label for="Permission" class="form-label">Permission</label>
            <select name="permission" id="permission" class="form-select" aria-label="Default select example">
                <option selected>Public</option>
                <option>Private</option>
                </select>
        </div>

        <button type="button" class="btn btn-primary btn-sm" onclick="insertOption(<?php echo $datos['bloqueID']; ?>,<?php echo $datos['optionLevel'] ?>,<?php echo $datos['orden'] ?>)">CONFIRM</button>
        <button type="button" class="btn btn-danger btn-sm" onclick="toggleBloqueActions('CERRAR_INSERT', <?php echo $datos['bloqueID'];?>)">CANCEL</button>
    </form>
</div>