<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
    class M_Menu extends Modelo{
        private $DAO;

        public function __construct(){
            parent::__construct();
            $this->DAO = new DAO();
        }


        public function getVistaMenuEdition($filtros){
            $action = '';
            $idUser = '';
            $idRole = '';
            $SQL = '';
            $datos = array();
            extract($filtros);

            switch($action){
                case 'menuGeneral': 
                    $SQL = "SELECT * FROM `menu`  ORDER BY ORDEN"; 
                    $datos['action'] = $action;
                    $datos['opcionesMenu'] = $this->DAO->consultar($SQL);
                    break;
                case 'permisosUser':
                    break;
                case 'rolesUser':
                    $SQL = "SELECT id_Permiso, permiso, id_Opcion FROM permisos ";
                    $datos['permisosOpcion'] = $this->DAO->consultar($SQL);
                    $datos['action'] = $action;
                    $datos['role'] = $idRole;
                    $SQL = "SELECT * FROM `menu`  ORDER BY ORDEN"; 
                    $datos['opcionesMenu'] = $this->DAO->consultar($SQL);
                    $SQL = "SELECT DISTINCT permisos.id_Opcion, permisos.num_Permiso, permisos.permiso FROM permisos,permisosrol WHERE permisos.id_Permiso=permisosrol.id_Permiso
                             AND permisosrol.id_Rol= '$idRole' ORDER BY `permisos`.`num_Permiso` ";
                    $datos['rolesMenu'] = $this->DAO->consultar($SQL);
                    break;
            }

            return $datos;
        }

        
        public function buscarMenu($filtros){
            
            

            $SQL_select = "SELECT * FROM menu WHERE (1=1)";
            $SQL = '';
            $SQL_final = '';

            if($filtros == 'public'){
                $SQL.=" AND permission = '$filtros'";
                $SQL_final = $SQL_select . $SQL;
            }else{
                $SQL_final = $SQL_select." ORDER BY ORDEN";
            }

            $menu = $this->DAO->consultar($SQL_final);
            
            return $menu;
        }


        public function updateOrden($datos){

            
            $orden = '';
            echo json_encode($orden);
            extract($datos);
            $SQL_update = "UPDATE menu SET orden = (orden + 1 ) WHERE orden >= '$orden'  ";


            $this->DAO->actualizar($SQL_update);
        }

        public function insertOption($datos){
            $permission  = '';
            $optionName  = '';
            $method      = '';
            $optionLevel = '';
            $orden    = '';

            extract($datos);

            $SQL_insert = "INSERT INTO `menu`( `optionName`, `permission`, `optionLevel`, `metodos`, `orden`)
            VALUES ('$optionName','$permission','$optionLevel','$method','$orden')";
            //$SQL_insert = "INSERT INTO menu VALUES('$optionName','$permission','$optionLevel','$method','$bloqueID')";

            $this->DAO->insertar($SQL_insert);
            
        }

        public function updateOption($datos){
            $nombreOpcion  ='';
            $permission = '';
            $id_Opcion = '';
            extract($datos);

            $SQL = "UPDATE menu SET optionName = '$nombreOpcion' , permission  = '$permission' WHERE id_Opcion = '$id_Opcion' ";

            $this->DAO->actualizar($SQL);
        }


        public function buscarPermisos($datos){
            $bloqueID = '';
            extract($datos);

            $SQL = "SELECT * FROM permisos WHERE `id_Opcion` = '$bloqueID' ORDER BY num_Permiso" ;
            $permisos  = $this->DAO->consultar($SQL);
            
            return $permisos;
        }


        public function updatePermiso($filtros){
            $id_Permiso = '';
            $permiso  = '';
            $num_Permiso  = '';
            

            extract($filtros);

            echo $bloqueID;
            echo $permiso;
            echo $num_Permiso;

            $SQL = "UPDATE `permisos` SET num_Permiso = '$num_Permiso', permiso  = '$permiso' WHERE id_Permiso = '$id_Permiso' ";

            $this->DAO->actualizar($SQL);

        }

        public function removePermiso($filtros){
            $id_Permiso = '';

            extract($filtros);

            $SQL = "DELETE from `permisos` WHERE id_Permiso = '$id_Permiso'";

            $this->DAO->actualizar($SQL);
        }

        public function addPermiso($filtros){
            $id_Opcion = '';
            $num_Permiso ='';
            $permiso ='';
            extract($filtros);

            $SQL = "INSERT INTO `permisos`(`id_Opcion`, `num_Permiso`, `permiso`) VALUES('$id_Opcion', '$num_Permiso','$permiso' )";
            
            $this->DAO->insertar($SQL);
        }


        public function buscarInfoMenuFiltros(){
            $datos = array();

            $datos['roles'] = $this->buscarRoles();
            $datos['usuarios'] = $this->buscarUsuarios();

            return $datos;

        }


        public function buscarRoles(){
            $SQL = "SELECT * FROM `roles`";
            return $this->DAO->consultar($SQL);
        }

        public function buscarUsuarios(){
            $SQL = "SELECT * FROM `usuarios` WHERE `activo` = 'S'";
            return $this->DAO->consultar($SQL);
        }


        public function manageUserRole($filtros){
            $idRole ='';
            $idUser ='';
            $action ='';
            $SQL ='';
            extract($filtros);
            echo $idRole;
            echo $idUser;
            
            if ($action == 'ASSIGN'){
                echo $action;
                $SQL = "INSERT INTO `rolesusuario`(`id_Rol`,`id_Usuario`) VALUES('$idRole','$idUser')";
                $this->DAO->insertar($SQL);
            }elseif($action == 'REVOKE'){
                $SQL = "DELETE FROM `rolesusuario` WHERE `id_Rol` = '$idRole' AND `id_Usuario` = '$idUser' ";
                $this->DAO->actualizar($SQL);
            }


            
        }

        

    

      
        
       


        
        
    }


?>