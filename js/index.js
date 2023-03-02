function guardar(){
    $('.inputRed').removeClass('inputRed');
    $('#msj').html('');
    if ($('#nombre').val() == ''  ){
        $('#nombre').addClass('inputRed');
    }

    if ($('#apellido_1').val() == ''  ){
        $('#apellido_1').addClass('inputRed');
    }

    if ($('#apellido_2').val() == ''  ){
        $('#apellido_2').addClass('inputRed');
    }


    if( $('.inputRed').length > 0 ){
        $('#msj').html('Revisa los campos en rojo');
    }else{
        $('#form').submit();
    }






}


