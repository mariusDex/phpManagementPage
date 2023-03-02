
/**
 * Author : Mariusz Broza
 * Desc   : Método para ejecutar el método buscar() de php para realizar queries en la base de datos
 * @returns : void
 */
function buscar(){
    var parametros='&controlador=Usuarios&metodo=buscar';
    // el serialize coge todos los campos del FORM (ftexto=valor&factivo=valor)
    parametros += '&' + $('#formularioBuscar').serialize();
    parametros += '&action=BUSCAR';
    console.log('HEMOS LLEGADO A buscar()');
    $.ajax({
        url: 'C_Ajax.php',
        type: 'post',
        data: parametros,
        success: function(vista){
            
            $('#capaResultadosBusqueda').html(vista);
        }
    })

    
}







/**
 * Author : Mariusz Broza
 * Desc   : Método para crear un nuevo usuario
 * @returns : void
 */
function crearUsuario(){
    var parametros='&controlador=Usuarios&metodo=insert';
    parametros += '&' + $('#formularioInsert').serialize();
    $('.inputRed').removeClass('inputRed');
    var camposValidos = validarCampos('CREATE');
    
    var validMail;
    var validLogin

    

    var validUpdate; 

    var mailCrear = $('.mailCrear').val();
    var loginCrear = $('.usuarioCrear').val();
    if(camposValidos == true){
        
        validLogin =  verificarLogin(loginCrear,'CREATE');
        if(validLogin == true){
            validUpdate = true;
            validMail = verificarMail(mailCrear,'CREATE');
            if(validMail == true){
                validUpdate = true;
            }else{
                validUpdate = false;
            }
        }else{
            validUpdate = false;
        }

        if(validUpdate == true){
            $.ajax({
                url: 'C_Ajax.php',
                type: 'post',
                data: parametros,
                
                success: function(){
                    buscar();
                    $('#formularioCrear').hide();
                    $('#capaResultadosBusqueda').show();
                    $('#botonCrearUser').show();
                }
            })
        }


        
    }
    
}



/**
 * Author : Mariusz Broza
 * Desc   : En función del boton que ejecuta este método, se hace una distribución de acciones correspondiente
 * @param {*} button 
 * @param {*} userID 
 * @param {*} login 
 * @param {*} mail 
 * @returns : void
 */
function toggleDisplay(button, userID, login, mail){
    


    switch (button){
        case 'EDIT' : 
            openEditPanel(userID);
            $('#formularioBuscar').hide();
        break;
        case 'SAVE' : 
           updateUsuario(userID,login,mail);
           //$('#capaResultadosBusqueda').show();
           //$('#formularioBuscar').show();
        break;
        case 'BUSCAR' :
            buscar();
            $('#capaResultadosBusqueda').show();   
            $('#botonCrearUser').show(); 
            $('#formularioBuscar').show();
            $('#formularioCrear').hide();  
            $('#userEditForm').hide();  
        break;
        case 'CREAR' :
            $('#capaResultadosBusqueda').hide();
            $('#botonCrearUser').hide();
            $('#formularioCrear').show();
            $('#userEditForm').hide();     
        break;

    }
   
    

}




/***********************************  FUNCIONES / MÉTODOS COMPLEMENTARIOS   ******************************************************** */


/**
 * Author : Mariusz Broza
 * Desc   : Método para abrir el panel de edición del usuario que le llegar por parámetro.
 * @param {*} userID 
 * @returns : void
 */
function openEditPanel(userID){
    console.log('ID USUARIO A EDITAR : ' + userID);
    var parametros='&controlador=Usuarios&metodo=showEditPanel';
    // el serialize coge todos los campos del FORM (ftexto=valor&factivo=valor)
    parametros += '&id_Usuario=' + userID; 

    $.ajax({
        url: 'C_Ajax.php',
        type: 'post',
        data: parametros,
        success: function(vista){
            $('#capaResultadosBusqueda').hide();
            $('#capaResultadosEditar').html(vista);
        }
    })

}
/**
 * Author : Mariusz Broza
 * Desc : método general para hacer el update a un usuario
 * @param {*} idUser 
 * @param {*} login 
 * @param {*} mail 
 * @returns : void
 */
function updateUsuario(idUser,login,mail){
    // """CONSTANTES""""
    
    var update_params = '&controlador=Usuarios&metodo=update';

    // booleanos para permitir el update o no 
    var loginPermitido;
    var mailPermitido;

    // parámetros para diferentes acciones
     

    // campos que tenemos que verificar si existen
    var loginNuevo = $('#loginEdit').val();
    var mailNuevo = $('#mailEdit').val();



    $('.inputRed').removeClass('inputRed');
    $('.error').hide();
    // VERIFICAMOS EL LOGIN
    var camposValidos = validarCampos('EDIT');
   
    
    if(camposValidos == true){
        if(loginNuevo != login){
            loginPermitido  =  verificarLogin(loginNuevo,'EDIT');
            
        }else{
            loginPermitido = true;
        }
    
        //  reseteamos los parámetros para los siguientes
        
        
        if(mailNuevo != mail){
            
            mailPermitido = verificarMail(mailNuevo,'EDIT');
        }else{
            mailPermitido = true;
        }
        
        // //mailPermitido = true;
        
        
        if(mailPermitido == true && loginPermitido == true){
         
            // COMPROBACIÓN FINAL 
            var parametros = '';
            parametros += update_params;
            parametros += '&id_Usuario=' + idUser;
            parametros += '&action=updateGeneral' ;
            parametros += '&' + $('#userEditForm').serialize();
            console.log(parametros);

            
            $.ajax({
                url: 'C_Ajax.php',
                type: 'post',
                data: parametros,
                
                success: function(){
                    
                    
                    getVista('Usuarios','vistaFiltrosUsuarios');
                    buscar();
                    $('#capaResultadosBusqueda').show();
                    $('#capaContenido').show();
                    $('#userEditForm' ).hide();
                    
                    
                }
            });
        }
    }    
}

/**
 * Author : Mariusz Broza
 * Desc   : Método que updatea solamente el  campo activo/inactivo de un usuario que le llega por parámetro
 * @param {*} userID 
 * @returns : void
 */
function cambiarActivo(userID){

    var changeOption;

    if($('#switchActivo' + userID).is(":checked")){
        changeOption = 'ACTIVAR';
    }else{
        changeOption = 'DESACTIVAR';
    }

    var parametros='&controlador=Usuarios&metodo=update';
    
    parametros += '&id_Usuario=' + userID;
    parametros += '&action=' + changeOption;
    
    console.log(parametros);

    $.ajax({
        url: 'C_Ajax.php',
        type: 'post',
        data: parametros,
        async : false,
        success: function(){
            
            if(changeOption == 'ACTIVAR'){
                $('#switchActivo' + userID).prop('checked', true);
            }else{
                $('#switchActivo' + userID).prop('checked', false);
            }
            
            
            
        }
    })
    



}


/******************************* FUNCIONES JQUERY ************************************/
function verificarLogin(loginNuevo,action){
    var parametrosBuscar = '&controlador=Usuarios&metodo=buscar';
    var loginPermitido;

            parametrosBuscar += '&loginNuevo=' + loginNuevo;
            parametrosBuscar += '&action=VERIFICAR';
            $.ajax({
                url: 'C_Ajax.php',
                type: 'post',
                data: parametrosBuscar,
                async : false,
                success: function(foundUser){
                    if(foundUser == 'TRUE'){
                        if(action == 'EDIT'){
                            $('.loginExist').show();
                            $('.usuarioEdit').addClass('inputRed');
                        }else{
                            $('.usuarioCrear').addClass('inputRed');

                        }
                        
                        
                        loginPermitido = false;
                    }else{
                        
                        loginPermitido = true;
                    }
                    
                }
            });

            return loginPermitido
}

function verificarMail(mailNuevo,action){
    
    var  parametrosBuscarMail = '&controlador=Usuarios&metodo=buscar'; 
    var mailPermitido;
            parametrosBuscarMail += '&mailNuevo=' + mailNuevo; 
            parametrosBuscarMail += '&action=VERIFICAR';   

            $.ajax({
                url: 'C_Ajax.php',
                type: 'post',
                data: parametrosBuscarMail,
                async : false,
                success: function(foundUser){
                    
                    if(foundUser == 'TRUE'){
                        if(action == 'EDIT'){
                            $('.mailExist').show();
                            $('.mailEdit').addClass('inputRed');
                        }else{
                            $('.mailCrear').addClass('inputRed');
                        }
                        
                        mailPermitido = false;
                    }else{
                        console.log(foundUser);
                        if(foundUser == 'FALSE'){
                            
                            mailPermitido = true;
                        }
                    }
                    
                    
                }
            });
    return mailPermitido;
}

/**
 * 
 * @param {*} formType 
 * @returns 
 */
function validarCampos(formType){
    
    // RECOGIDA DE ENTRADAS DEL FORM DE EDIT
    $('.inputRed').removeClass('inputRed');
    
    // booleanos para aprobar el update de los campos
    var validLoginEdit = false;
    var validMailEdit   = false;
    var validMovilEdit  = false;
    var validNombreEdit     = false;
    var validApellido_1Edit     = false;

    var regexMovil = /^[0-9]*$/;
    var allValid;

    var loginEdit = $('.usuarioEdit').val();
    var mailEdit = $('.mailEdit').val();
    var movilEdit = $('.movilEdit').val();
    var nombreEdit = $('.nombreEdit').val();
    var apellido_1Edit = $('.apellido_1Edit').val();

    var validLoginCrear;
    var validMailCrear;
    var validMovilCrear;
    var validNombreCrear;
    var validApellido_1Crear;
    var validApellido_2Crear;
    var validPassCrear;
    var validSexoCrear;

    var loginCrear = $('.usuarioCrear').val();
    var mailCrear = $('.mailCrear').val();
    var movilCrear = $('.movilCrear').val();
    var nombreCrear = $('.nombreCrear').val();
    var apellido_1Crear = $('.apellido_1Crear').val();
    var apellido_2Crear = $('.apellido_2Crear').val();
    var passCrear = $('.passCrear').val();
    var sexoCrear = $('.sexoCrear').val();
    
    
    

    switch(formType){

        case 'EDIT' :

            if(loginEdit.length < 5 || loginEdit.length > 20){
                $('.usuarioEdit').addClass('inputRed');
                validLoginEdit  = false;
            }else{
                validLoginEdit = true;
            }
                
            if(mailEdit.length < 8 || mailEdit.length > 50  ){
                $('.mailEdit').addClass('inputRed');
                validMailEdit  = false;
            }else{
                validMailEdit  = true;
                    
            }

            if(movilEdit.length <9 || movilEdit.length > 20 ){
                $('.movilEdit').addClass('inputRed');
                validMovilEdit = false;
            }else{
                validMovilEdit = true;
            }

            if(nombreEdit.length < 3 || nombreEdit.length > 30){
                validNombreEdit = false;
                $('.nombreEdit').addClass('inputRed');
            }else{
                validNombreEdit = true;
            }

            if(apellido_1Edit.length < 3 || apellido_1Edit.length > 30){
                validApellido_1Edit = false;
                $('.apellido_1Edit').addClass('inputRed');
            }else{
                validApellido_1Edit = true;
            }

            if( validLoginEdit == true && validMailEdit == true && validMovilEdit  == true && validNombreEdit  == true && validApellido_1Edit  == true){
                allValid = true;
            }else{
                allValid = false;
            }

            break;
        case 'CREATE' :

            if(loginCrear.length < 5 || loginCrear.length > 20){
                $('.usuarioCrear').addClass('inputRed');
                validLoginCrear  = false;
            }else{
                validLoginCrear = true;
            }
                
            if(mailCrear.length < 8 || mailCrear.length > 50  ){
                $('.mailCrear').addClass('inputRed');
                validMailCrear  = false;
            }else{
                validMailCrear  = true;
                    
            }

            if(movilCrear.length <9 || movilCrear.length > 20 ){
                $('.movilCrear').addClass('inputRed');
                validMovilCrear = false;
            }else{
                validMovilCrear = true;
            }

            if(nombreCrear.length < 3 || nombreCrear.length > 30){
                validNombreCrear = false;
                $('.nombreCrear').addClass('inputRed');
            }else{
                validNombreCrear = true;
            }

            if(apellido_1Crear.length < 3 || apellido_1Crear.length > 30){
                validApellido_1Crear = false;
                $('.apellido_1Crear').addClass('inputRed');
            }else{
                validApellido_1Crear = true;
            }

            

            if(passCrear.length < 6 || passCrear.length > 30){
                validPassCrear = false;
                $('.passCrear').addClass('inputRed');
            }else{
                validPassCrear = true;
            }

            if(sexoCrear == '' || sexoCrear == null){
                validSexoCrear = false;
                $('.sexoCrear').addClass('inputRed');
            }else{
                validSexoCrear = true;
            }



            if( validLoginCrear == true && 
                validMailCrear == true &&
                 validMovilCrear  == true &&
                  validNombreCrear  == true &&
                   validApellido_1Crear  == true){
                allValid = true;
            }else{
                allValid = false;
            }

            break;


    }
        
    
    

    return allValid;
    

}
