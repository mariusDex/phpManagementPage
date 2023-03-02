<?php
require_once 'controladores/Controlador.php';
require_once 'vistas/Vista.php';
require_once 'modelos/M_Usuarios.php';



class C_Usuarios extends Controlador{

    private $modelo;

    public function __construct(){
        parent::__construct(); // ejecutar constructor "padre"
        $this->modelo = new M_Usuarios();

    }



    public function vistaFiltrosUsuarios($parametros){
        // 1 FORMA DE HACER LA LLAMADA A LA VISTA
        
        //$vis = new Vista();
        //$vis->render('vistas/Usuarios/V_Usuarios_Filtros.php');

        // 2ª forma de hacer la llamada a la vista

    
        Vista::render('vistas/Usuarios/V_Usuarios_Filtros.php');

    }

    public function buscar($filtros){
        //echo json_encode($filtros);
        //buscar usuarios filtrados
        $action = '';
        $foundUser = '';
        extract($filtros);

        switch($action){
            case 'BUSCAR' : 
                $usuarios = $this->modelo->buscarUsuarios($filtros);
                //mostrar listado
                Vista::render('vistas/Usuarios/V_Usuarios_Listado.php' , $usuarios);
                break;
            case 'VERIFICAR' :
                $usuarios = $this->modelo->buscarUsuarios($filtros);
                if(empty($usuarios)){
                    $foundUser = 'FALSE'; 
                }else{
                    $foundUser = 'TRUE';
                }
                echo $foundUser;
                break; 

        }
       
    }

    public function insert($filtros){
        echo json_encode($filtros);
        $this->modelo->crearUsuario($filtros);
        
    }

    public function update($filtros){
        $this->modelo->updateUsuario($filtros);

    }


    /*******************************  RESTO DE MÉTODOS ************************************* */
    /** 
     * @author : Mariusz Broza
     * Desc : método para mostrar la vista del panel de edición de un usuario
     * @return : void
     **/
    public function showEditPanel($datos){
        
        $usuario = $this->modelo->buscarUsuarios($datos);
        
        Vista::render('vistas/Usuarios/V_Usuarios_Edit.php', $usuario[0]);

    }

    public function checkLogin($credentials){
        
        $foundUser = $this->modelo->checkLogin($credentials);
        // devuelve true o false en función de si lo ha encontrado o no
        echo $foundUser;
        
    }

    
}

?>