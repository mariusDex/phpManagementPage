<script src="js/usuarios.js"></script>
<script src="js/app.js"></script>
<script src="js/menu.js"></script>
<link rel="stylesheet" href="css/index.css">




<nav class="navbar navbar-expand-sm navbar-light bg-light" id="navGeneral">
    <a class="navbar-brand" href="#" style="border-right: 2px solid orange;padding-right : 10px">Menu</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
         <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">

                <?php
                $menuFinal = array();
                
                foreach($datos as $key=>$registro){
                    
                    if($registro['optionLevel'] == 0){
                        $menuFinal[$registro['id_Opcion']] = $registro;
                        $menuFinal[$registro['id_Opcion']]['childOptions'] = array();
                    }else{
                        $menuFinal[$registro['optionLevel']]['childOptions'][] = $registro;
                    }
                }


                foreach($menuFinal as $registro){
                    if(empty($registro['childOptions'])){
                        ?>  
                            <li class="nav-item active">
                                <a class="nav-link" href="#"><?php echo $registro['optionName']; ?></a>
                            </li>
                        <?php
                    }else{ 
                        ?>
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?php echo $registro['optionName']; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                    <?php foreach($registro['childOptions'] as $childOptions){
                         ?><a class="dropdown-item" onclick="<?php echo $childOptions['metodos'];?>" href="#"><?php  echo $childOptions['optionName']; ?></a> 
                    <?php }
                     ?>
                     </div>
                    
                </li>
                <?php

                    }
                }

                ?>

                </ul>
            </div>
</nav>
