<script src="librerias/jquery-3.5.1/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="librerias/bootstrap-4.5.2-dist/css/bootstrap.min.css">
<script src="librerias/bootstrap-4.5.2-dist/js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
<script src="js/menu.js"></script>
<script src="js/index.js"></script>

<br>

<?php 
require_once('Vistas/Menu/menuFunctions.php');
$menuFinal = array();

foreach($datos['opcionesMenu'] as $key => $registro){
    if($registro['optionLevel'] == 0){
        $menuFinal[$registro['id_Opcion']] = $registro;
        $menuFinal[$registro['id_Opcion']]['childOptions'] = array();
    }else{
        $menuFinal[$registro['optionLevel']]['childOptions'][] = $registro;
    }
    
}

?>
    <!--<button class="btn btn-success btn-sm" onclick="toggleBloqueInsert('ABRIR',0)">Add</button>
    <div class="insertBlocks" style="display:none" id="bloqueInsertMenu0"></div> -->
 <?php

    recursivePrintOptions($menuFinal,$datos);

?>



