<!DOCTYPE html>
<html>
<head>
    
</head>
<body>

<?php

// Con el $ se declara la variable
    $saludo =  'Hola';
    $msj = '<br>$saludo chicos/as';

    $msj= "<br>$saludo chicos/as";
    $msj= '<br>'.$saludo.'chicos/as';
    $msj= '<br>'.$saludo.'chicos/as';
    //echo $msj;
    // Para crear un array
    $matriz=array();
    $matriz=array('a','b','c',6);
    $matriz[]='Pepe';
    $matriz[0]='aaa';
    $matriz[]=array('1','5','9');


    // ========== PARA IMPRIMIR MATRICES ============ //

    // Para sacar el 9 dentro del array que esta dentro del  array $matriz
    echo $matriz[5][2];

    // Con el <pre></pre> le damos un formato de visualización a la matriz
    echo '<pre>';
    // Imprimir la matriz
    print_r($matriz);
    echo '</pre>';

    // otra forma de visualizar la matriz
    var_dump($matriz);


    // ========== FIN DE 'PARA IMPRIMIR MATRICES' ============ //
    echo $msj;
    echo '<br><br>';
   
    // Recorremos un array, creando una variable $x como contador
    $nombres  = array('Javier','Ivan','Pablo');

    for( $x=0 ; $x < sizeof($nombres) ; $x++){
        echo '<br>'.$nombres[$x];
    }

    $nombres = '';
    if ( !empty($nombres)){
        foreach( $nombres as $indice => $elNombre ){
            echo '<br> En la posición '.$indice.' está : '.$nombres[$indice];
        }
    }

    // Para crear una constante

    define('CENTRO', 'San Valero' );

    
?>
    <br>(c) <?php echo CENTRO; ?>
    <br>(c) <?=CENTRO; ?>


</body>
</html>