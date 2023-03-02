<?php
require_once 'modelos/Modelo.php';
require_once 'modelos/DAO.php';
    class M_Usuarios extends Modelo{
        private $DAO;

        public function __construct(){
            parent::__construct();
            $this->DAO = new DAO();
        }
        /**
         * Author : Mariusz Broza
         * Fecha  : --/--/--
         * Desc   : realiza la query correspondiente a la búsqueda de todos los datos de cierto usuario filtrado
         * @param : $filtros --> Todo los parámetros por los cuales se quiere realizar la búsqueda
         * @return : [] de usuarios.
         */
        public function buscarUsuarios($filtros){
            $SQL_select = "SELECT * FROM usuarios WHERE 1=1";
            $SQL = '';
            $SQL_final = '';
            $ftexto ='';
            $factivo = '';
            $login = '';
            $nombre = '';
            $sexo = '';
            $mail = '';
            $id_Usuario = '';
        
            $loginNuevo  = '';
            $mailNuevo = '';

            // el extract() 
            // coge un array y todos los campos los crea como variables
            extract($filtros);

            $usuarios = array();
            

            if($factivo!=''){
                // al usar comillas dobles php buscar variables dentro
                $SQL.=" AND activo='$factivo' ";

            }
            if($ftexto!=''){
                // en array Texto se guardará una palabra por cada espacio que tenga
                $arrayTexto = explode(' ',$ftexto);
                $SQL.=" AND (1=2";
                foreach($arrayTexto as $palabra){
                    $SQL.=" OR nombre LIKE '%$palabra%' ";
                    $SQL.=" OR mail LIKE '%$palabra%' ";
                    $SQL.=" OR apellido_1 LIKE '%$palabra%' ";
                    $SQL.=" OR apellido_2 LIKE '%$palabra%' ";
                    $SQL.=" OR login LIKE '%$palabra%' ";
                    
                }
                $SQL.=" ) ";
                // al usar comillas dobles php buscar variables dentro
                //$SQL.=" AND nombre LIKE '%$ftexto%' ";
            }
            if($login != '' || $login != null){
                $SQL.=" AND login = UPPER('$login') ";
            }
            if($nombre != '' || $nombre != null){
                $SQL.=" AND nombre = UPPER('$nombre') ";
            }
            if($sexo != '' || $sexo != null){
                $SQL.=" AND sexo = UPPER('$sexo') ";
            }
            if($mail != '' || $mail != null){
                $SQL.=" AND mail = UPPER('$mail') ";
            }

            if($mailNuevo != '' || $mailNuevo != null){
                $SQL.=" AND mail = UPPER('$mailNuevo') ";
            }

            if($id_Usuario != '' || $id_Usuario != null){
                $SQL.=" AND id_Usuario = $id_Usuario";
            }

            if($loginNuevo != '' || $loginNuevo != null){
                $SQL.=" AND login = UPPER('$loginNuevo') ";
            }
            $SQL.=" ORDER BY login";
            $SQL_final = $SQL_select . $SQL;
         
            $usuarios = $this->DAO->consultar($SQL_final);

            return $usuarios;
        }

        /**
         * Desc : método para crear un usuario  e insertar en BBDD
         * @author : Mariusz Broza
         * Fecha   :  --/--/--
         * @param  : $datos  ---> datos[] compuesto por campo => valor (string) de la información del usuario a crear
         * @return  : void
         */
        public function crearUsuario($datos){

           
            $login = '';
            $pass = '';
            $nombre = '';
            $apellido_1 = '';
            $apellido_2 = '';
            $sexo = '';
            $mail = '';
            $movil = '';

            extract($datos);
            echo $usuario;
            $SQL = "INSERT INTO `usuarios`( `nombre`, `apellido_1`, `apellido_2`, `sexo`, `fecha_Alta`, `mail`, `movil`, `login`, `pass`, `activo`)
            VALUES ('$nombre','$apellido_1','$apellido_2','$sexo',CURRENT_DATE,'$mail','$movil','$login',md5('$pass'),'S')";

            $this->DAO->insertar($SQL);
        }

        /**
         * Author : Mariusz Broza
         * Desc   : método parametrizado para el update de un suuario en concreto
         * @param : parámetros con los campos a updater de un usuario
         * @return : void
         */
        public function updateUsuario($datos){

            

            $action = '';

            $loginActual  = '';
            $mailActual = '';

            $id_Usuario = '';
            $login = '';
            $nombre = '';
            $apellido_1 = '';
            $sexo = '';
            $movil = '';
            $mail = '';
            

            extract($datos);

            switch($action){
                case 'ACTIVAR' : 
                    $SQL = "UPDATE `usuarios` SET 
                    `activo`= 'S'
                    WHERE `id_Usuario` = $id_Usuario";
                    break;
                case 'DESACTIVAR' :
                    $SQL = "UPDATE `usuarios` SET 
                    `activo`= 'N'
                    WHERE `id_Usuario` = $id_Usuario";
                    break;
                case 'updateGeneral' :
                    $SQL = "UPDATE `usuarios` SET 
                    `nombre`= '$nombre',
                    `apellido_1` = '$apellido_1',
                    `mail` = '$mail',
                    `movil` = '$movil',
                    `login` = '$login',
                    `sexo` = '$sexo' 
                    WHERE `id_Usuario` = $id_Usuario";
            
                    echo $SQL;

                break;
                                




            }
            
            $this->DAO->actualizar($SQL);
        }

        

        /**
         * Author : Mariusz Broza
         * Fecha  : --/--/--
         * Desc   : comprueba que exista un login y usuario en la bbdd
         * @param : $credentials ---> login y usuario 
         * @return : void
         */
        public function checkLogin($credentials){

            $login = '';
            $pass= '';
            extract($credentials);
            
            $found = '';

            // consulta
            $SQL = "SELECT * FROM `usuarios` WHERE `login` = '$login' AND `pass` =md5('$pass')  ";
            $data  = $this->DAO->consultar($SQL);
         
            if(json_encode($data) == '[]'){
                $found = 'FALSE';
            }else{
                $found = 'TRUE';
            }


            return ($found);
        }
    }


?>