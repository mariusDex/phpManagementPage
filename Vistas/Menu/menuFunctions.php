<script src="js/menu.js"></script>
<?php 



function recursivePrintOptions($menu,$datos){
    //echo json_encode($menu);

    foreach($menu as $tmp => $registro){
       //echo json_encode($registro);
    ?> 
    
    <div class="optionDiv col-lg-2" style="padding:2px;border-radius:10px;background-color:white;margin-bottom:5px"><?php echo $registro['optionName']; ?></div>
    
    <div id="updateMenu<?php echo $registro['id_Opcion'];  ?>" style="display: none">
        <input type="text"  id="nombreUpdate<?php echo $registro['id_Opcion'];  ?>" name="nombreUpdate"  placeholder="<?php echo $registro['optionName']; ?>"/><br>
        <select name="permissionUpdate" id="permissionUpdate<?php echo $registro['id_Opcion'];  ?>" class="form-select" aria-label="Default select example">
                    <option selected>Public</option>
                    <option>Private</option>
        </select><br>
        <button type="button" class="btn btn-primary btn-sm" onclick="updateOpcion(<?php echo $registro['id_Opcion']; ?>)">Update</button><button class="btn btn-danger btn-sm" onclick="toggleUpdateDiv('CERRAR','<?php echo $registro['id_Opcion'];  ?>')">Cancel</button><br>
        
    </div>

    <?php
    if($datos['action'] == 'rolesUser'){
        permisosRol($datos,$registro['id_Opcion']);
    }else{
    ?>
        <button type="button" id="updateShow<?php echo $registro['id_Opcion'];  ?>" class="btn btn-primary btn-sm" onclick="toggleUpdateDiv('ABRIR', '<?php echo $registro['id_Opcion'];  ?>')">Update</button>
        <button type="button" class="btn btn-success btn-sm" onclick="toggleBloqueActions('ABRIR_INSERT',<?php echo $registro['id_Opcion']; ?>,<?php echo $registro['optionLevel'] ?>,<?php echo $registro['orden']; ?>)" >Add  ↓</button>
        <button type="button" class="btn btn-info btn-sm" onclick="toggleBloqueActions('ABRIR_PERMISOS',<?php echo $registro['id_Opcion']; ?>,<?php echo $registro['optionLevel'] ?>,<?php echo $registro['orden']; ?>)" >Permissions</button>
    <?php } ?> 
    <br>
    <br>
    <div style="display:none" class="insertBlocks" id="bloqueInsertMenu<?php echo $registro['id_Opcion'] ?>"></div>
    <br>
    <?php
        if(empty($registro['childOptions'])){ 
        
            }else{
        ?>
    
            <div style="margin-left:50px"><?php recursivePrintOptions($registro['childOptions'],$datos); ?></div>    
                
                
            <?php
        }
    }
    
}



function permisosRol($datos,$idOpcion){
    $arrayPermisos = array();
    foreach ($datos['permisosOpcion'] as $key => $permisosOpcion) {
        if($permisosOpcion['id_Opcion'] == $idOpcion){
            array_push($arrayPermisos, $permisosOpcion['permiso']);
        }
        
    }
    $mapaPermisos = array();
    // Llenamos mapa
    foreach($arrayPermisos as $key => $permisosGeneral){
        $mapaPermisos[$permisosGeneral] = ''; 
    }

    // asignamos a cada posición del mapa lo correspondiente
    foreach($datos['rolesMenu'] as $key => $rolOpcion){
        if($rolOpcion['id_Opcion'] == $idOpcion){
            $mapaPermisos[$rolOpcion['permiso']] = 'hasPermission';
        }
    }

    foreach($arrayPermisos as $key => $permisosGeneral){
        if($mapaPermisos[$permisosGeneral] != ''){
            ?>
            <button type="button"  class="btn btn-success btn-sm" style="margin-bottom: 3px;"><?php echo $permisosGeneral ?></button><br>
            <?php
        }else{
            ?>
            <button type="button" class="btn btn-danger btn-sm" style="margin-bottom: 3px;"><?php echo $permisosGeneral ?></button><br>
            <?php
        }   
    }
}

?>