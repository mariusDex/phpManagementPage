<?php
require_once 'controladores/Controlador.php';
require_once 'vistas/Vista.php';
require_once 'modelos/Modelo.php';
require_once 'modelos/M_Menu.php';



class C_Menu extends Controlador{

    private $modelo;
    
    public function __construct(){
        parent::__construct(); // ejecutar constructor "padre"
        $this->modelo = new M_Menu();

    }


    public function getVistaMenu($filtros){

        $datos = $this->modelo->buscarMenu($filtros);
        Vista::render('vistas/Menu/V_Menu.php', $datos);
    }


    



    public function getVistaMenuManagement($filtros){
        $datos = $this->modelo->buscarMenu($filtros);
        Vista::render('vistas/Menu/V_Menu_Management.php', $datos);        
    }

    public function getVistaMenuEdition($filtros){
        $datos = $this->modelo->getVistaMenuEdition($filtros);
        Vista::render('vistas/Menu/V_Menu_Management.php', $datos);
    }

    public function getVistaMenuFiltros(){
        $datos = $this->modelo->buscarInfoMenuFiltros();

        Vista::render('vistas/Menu/V_Menu_Filtros.php',$datos);

    }

    public function getSelectRoles(){
        $datos = $this->modelo->buscarRoles();
        Vista::render('vistas/Menu/V_Menu_Roles.php',$datos);
    }
    public function getSelectUsuarios(){
        $datos = $this->modelo->buscarUsuarios();
        Vista::render('vistas/Menu/V_Menu_Usuarios.php',$datos);
    }
    

    public function insertOption($datos){
        $this->modelo->updateOrden($datos);
        $this->modelo->insertOption($datos);
    }
    
    public function updateOption($datos){
        $this->modelo->updateOption($datos);
    }

    public function showInsertBlock($datos){
        Vista::render('vistas/Menu/V_Menu_Insert.php',$datos);
    }

    public function showPermissions($filtros){
        $datos = $this->modelo->buscarPermisos($filtros);
        Vista::render('vistas/Menu/V_Menu_Permisos.php',$datos);
    }

    public function showPermisoEditar($datos){
        Vista::render('vistas/Menu/V_Menu_Editar_Permiso.php', $datos);
    }

    public function updatePermiso($filtros){
        $this->modelo->updatePermiso($filtros);
    }

    public function removePermiso($filtros){
        $this->modelo->removePermiso($filtros);
    }

    public function addPermiso($filtros){
        $this->modelo->addPermiso($filtros);
    }

    public function showAddPermiso($datos){
        Vista::render('vistas/Menu/V_Menu_Insert_Permiso.php', $datos);
    }

    public function manageUserRole($filtros){
        $this->modelo->manageUserRole($filtros);
    }



   
    
    



    
    
}

?>