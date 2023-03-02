function buscarMantenimientoMenu(){
    var parametros='&controlador=Menu&metodo=getVistaMenuEdition';
    var action;
    var idRole = $('#selectRole').val();
    var idUser = $('#selectUser').val(); 

    if(idRole == '-1' && idUser == '-1'){
        action = 'menuGeneral';
    }else if(idRole == '-1' && idUser != '-1'){
        action = 'permisosUser';
    }else if(idRole != '-1' && idUser == '-1'){
        action = 'rolesUser';
    }else if(idRole != '-1' && idUser != '-1'){
        action = 'invalid'
    }

    if(action != 'invalid'){
        parametros += '&action=' + action;
        parametros += '&idRole=' + idRole;
        parametros += '&idUser=' + idUser;
        
        $.ajax({
            url: 'C_Ajax.php',
            type: 'post',
            data: parametros,
            async : true,
            success: function(vista){
                $('#capaResultadosBusquedaMenu').html(vista);
            }
        })
    }
    
}

function verifySelection(){
    var idRole = $('#selectRole').val();
    var idUser = $('#selectUser').val(); 
    $('#botonesManageRo le').hide();
    if(idRole != '-1' && idUser != '-1'){
        $('#botonesManageRole').show();
    }else{
        $('#botonesManageRole').hide();
    }
}

function manageUserRole(action){
    
    var idRole = $('#selectRole').val();
    var idUser = $('#selectUser').val(); 
    var msg;
    if(action == 'ASSIGN'){
        msg = 'El rol ha sido asignado con éxito !';
    }else{
        msg = 'El rol ha sido desasignado con éxito !';
    }
    
    if(idRole != '-1' && idUser != '-1'){
        var parametros='&controlador=menu&metodo=manageUserRole';
        parametros += '&idRole='+ idRole;
        parametros += '&idUser='+ idUser;
        parametros += '&action='+ action;    
        //console.log('HEMOS LLEGADO A buscar()');
        $.ajax({
            url: 'C_Ajax.php',
            type: 'post',
            data: parametros,
            async : true,
            success: function(vista){
                
                $('#msgRoleManage').html(msg);
                $('#msgRoleManage').show();

                
                setTimeout(function() {
                    $("#msgRoleManage").hide();
                },3000);

            }
        })
    }
    
}





function getVistaMenuFiltros(){
    var parametros='&controlador=menu&metodo=getVistaMenuFiltros';
    
    $.ajax({
        url: 'C_Ajax.php',
        type: 'post',
        data: parametros,
        async : true,
        success: function(vista){
            
            $('#capaContenido').html(vista);
        }
    })

}
/*
function mostrarRoles(){
    var parametros='&controlador=menu&metodo=getSelectRoles';
    
    
    $.ajax({
        url: 'C_Ajax.php',
        type: 'post',
        data: parametros,
        success: function(vista){

           
            $('#divRoles').show();
            $('#divRoles').html(vista);
        }
    })
}

function mostrarUsuarios(){
    var parametros='&controlador=menu&metodo=getSelectUsuarios';
    
    
    $.ajax({
        url: 'C_Ajax.php',
        type: 'post',
        data: parametros,
        success: function(vista){

            
            $('#divUsuarios').show();
            $('#divUsuarios').html(vista);
        }
    })
}*/

function showInsertBlock(controlador,metodo, bloqueID,optionLevel,orden){
    var parametros='&controlador='+controlador+'&metodo='+metodo+'&bloqueID='+bloqueID+'&optionLevel='+optionLevel+'&orden='+orden;
    
    
    $.ajax({
        url: 'C_Ajax.php',
        type: 'post',
        data: parametros,
        success: function(vista){

            $('.insertBlocks').html('');
            $('#bloqueInsertMenu' + bloqueID).show();
            $('#bloqueInsertMenu' + bloqueID).html(vista);
        }
    })
    
}

function showPermissions(controlador,metodo,bloqueID){
    var parametros='&controlador='+controlador+'&metodo='+metodo+'&bloqueID='+bloqueID;
    
    
    $.ajax({
        url: 'C_Ajax.php',
        type: 'post',
        data: parametros,
        success: function(vista){
            
            $('.insertBlocks').html('');
            $('#bloqueInsertMenu' + bloqueID).show();
            $('#bloqueInsertMenu' + bloqueID).html(vista);
        }
    })
    
}


function toggleBloqueActions(action,bloqueID,optionLevel,orden){
    
    switch(action){
        case 'ABRIR_INSERT' :
            showInsertBlock('menu','showInsertBlock', bloqueID, optionLevel,orden+1);
            $('#bloqueBotones'+bloqueID).hide();
        break;
        case 'CERRAR_INSERT' :
            $('#bloqueInsertMenu' + bloqueID).hide();
            $('#bloqueBotones'+bloqueID).show();
        break;
        case 'ABRIR_PERMISOS' :
            showPermissions('menu','showPermissions', bloqueID);
            $('#bloqueBotones'+bloqueID).hide();
            break;
        case 'CERRAR_PERMISOS' :
            $('#bloqueInsertMenu' + bloqueID).hide();
            $('#bloqueBotones'+bloqueID).show();
            break;
        case 'ABRIR_EDITAR_PERMISO' :
            showPermisoEditar(bloqueID,optionLevel);
            break;
        case 'CERRAR_EDITAR_PERMISO' :
            $('#editarPermiso' + bloqueID).hide();
            break;
        case 'ABRIR_ADD_PERMISO':
            showAddPermiso(bloqueID,optionLevel);
            break;
        case 'CERRAR_ADD_PERMISO':
            $('#insertarPermisoDiv'+bloqueID).hide();

    }
}

function updatePermiso(idPermiso,id_Opcion){
    var parametros='&controlador=menu&metodo=updatePermiso&id_Permiso='+idPermiso+'&id_Opcion='+id_Opcion;
    parametros += '&' + $('#formEditarPermiso'+idPermiso).serialize();
        $.ajax({
            url: 'C_Ajax.php',
            type: 'post',
            data: parametros,
            success: function(response){
                showPermissions('menu','showPermissions',id_Opcion);
            }
        })

}

function addPermiso(id_Opcion){
    var parametros='&controlador=menu&metodo=addPermiso&id_Opcion='+id_Opcion;
    
    parametros += '&' + $('#formInsertarPermiso'+id_Opcion).serialize();
        $.ajax({
            url: 'C_Ajax.php',
            type: 'post',
            data: parametros,
            success: function(response){
                showPermissions('menu','showPermissions',id_Opcion);
            }
        })

}

function updateOpcion(id_Opcion){
    var nombreOpcion = $('#nombreUpdate'+id_Opcion).val();
    var permission = $('#permissionUpdate'+id_Opcion).val();

    var parametros='&controlador=menu&metodo=updateOption&id_Opcion='+id_Opcion;
    parametros += '&nombreOpcion='+ nombreOpcion;
    parametros += '&permisson='+permission;
        $.ajax({
            url: 'C_Ajax.php',
            type: 'post',
            data: parametros,
            success: function(response){
                buscarMantenimientoMenu();
            }
        })
}

function removePermiso(idPermiso, id_Opcion){
    var parametros='&controlador=menu&metodo=removePermiso&id_Permiso='+idPermiso;
        $.ajax({
            url: 'C_Ajax.php',
            type: 'post',
            data: parametros,
            success: function(response){
                showPermissions('menu','showPermissions',id_Opcion);
            }
        })
}

function showAddPermiso(id_Opcion){
    var parametros='&controlador=menu&metodo=showAddPermiso&id_Opcion='+id_Opcion;
    
    $.ajax({
        url: 'C_Ajax.php',
        type: 'post',
        data: parametros,
        success: function(response){
            $('#insertarPermisoDiv' + id_Opcion).show();
            $('#insertarPermisoDiv' + id_Opcion).html(response);  
        }
    }) 
}

function showPermisoEditar(bloqueID,id_Opcion){
        
            
        var parametros='&controlador=menu&metodo=showPermisoEditar&id_Permiso='+bloqueID+'&id_Opcion='+id_Opcion;
        $.ajax({
            url: 'C_Ajax.php',
            type: 'post',
            data: parametros,
            success: function(response){
                $('#editarPermiso' + bloqueID).show();
                $('#editarPermiso' + bloqueID).html(response);  
            }
        })
}

function insertOption(bloqueID,optionLevel,orden){
    console.log('INSERTANDO MENU...');
    
    var parametros='&controlador=menu&metodo=insertOption&bloqueID='+bloqueID+'&optionLevel='+optionLevel+'&orden='+orden;
    parametros += '&' + $('#insertMenuForm'+bloqueID).serialize();
    $.ajax({
        url: 'C_Ajax.php',
        type: 'post',
        data: parametros,
        success: function(response){
            buscarMantenimientoMenu();
            /*
            var parametros='&controlador=Menu&metodo=getVistaMenuManagement';
    
            console.log('HEMOS LLEGADO A buscar()');
            $.ajax({
                url: 'C_Ajax.php',
                type: 'post',
                data: parametros,
                success: function(vista){
                    
                    $('#capaResultadosBusquedaMenu').html(vista);
                }
            })
            */
                    
            
            
            
        }
    })
}

function toggleUpdateDiv(action, div){
    switch(action){
        case 'ABRIR':
            $('#updateMenu'+ div).show();
            $('#updateShow'+ div).hide();
            break;
        
        case 'CERRAR':
            $('#updateMenu'+ div).hide();
            $('#updateShow'+ div).show();
            break;
        
        case 'UPDATE':
            break;

    }

}

