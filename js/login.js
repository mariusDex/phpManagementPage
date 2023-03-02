document.addEventListener("keyup", function(event) {
    if (event.key === 'Enter') {
        validar();
    }
});
/**
 * Author : Mariusz Broza
 * Desc   : Método que valida si el usuario y la contraseña coinciden en BBDD
 * return : void
 */
function validar(){    
    var parametros = '&controlador=Usuarios&metodo=checkLogin';
 
    parametros += '&' + $('#formLogin').serialize(); 
    $('.invalidLogin').hide();
    $.ajax({
        url: 'C_Ajax.php',
        type: 'post',
        data: parametros,
        success: function(foundUser){
            
            console.log(foundUser);
            if(foundUser == 'TRUE'){
                $('#formLogin').submit();   
               console.log(foundUser);

            }else{
                $('#loginEntry').val('');
                $('#passEntry').val('');
                $('.invalidLogin').show();
            }
        }
    })





}


