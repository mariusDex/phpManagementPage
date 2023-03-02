<?php session_start();

$getPost=array_merge($_POST, $_GET, $_FILES);

if(isset($getPost['controlador'])){

    $controlador = $getPost['controlador'];
    $metodo = $getPost['metodo'];
    $nombreControlador='C_'.$controlador;
    if(file_exists('./controladores/'.$nombreControlador.'.php')){

        require_once './controladores/'.$nombreControlador.'.php';
        $objControlador= new $nombreControlador();
        if(!method_exists($objControlador, $metodo)){
            echo 'NO hay nada que ejecutar';
        }else{
            $objControlador->$metodo($getPost);
        }
    }else{
        echo 'No lo he encontrado';
    }
}else{
    echo 'No se ha podido realizar';
}


?>