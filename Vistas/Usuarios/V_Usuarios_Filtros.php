
<script src="js/usuarios.js"></script>
<link rel="stylesheet" href="css/index.css">
 <!-- FONT -->
 <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;532&display=swap" rel="stylesheet">
   <!-- END FONT -->
<?php

// echo 'He llegado a la vista de filtros';

?>
    
    <form action="" id="formularioBuscar" name="formularioBuscar">
        <br>
        <div class="container-fluid">
        
            <div class="row col-lg-5">
                <label for="ftexto" >Nombre/texto</label><br>
                    <input type="text" id="ftext" name="ftexto" class="form-control"
                        placeholder="Texto a buscar" value="" />
            </div>

            <div class="row col-lg-5">
            <label for="factivo">Estado</label><br>
                <select id="factivo" name="factivo" class="form-control">
                    <option value="">Todo</option>
                    <option value="S" selected>Activos</option>
                    <option value="N">No activos</option>
                </select>

            </div>

                <br>

           


            <div class="row">
                <div class="form-group col-lg-5 col-md-6 ">
                    <button type="button"  class="btn btn-info" onclick="toggleDisplay('BUSCAR')">Buscar</button>
                    <button id="botonCrearUser" type="button" class="btn btn-primary crearUserButton"   onclick="toggleDisplay('CREAR')">Crear nuevo</button>  
                </div>
            </div>
                
            


        </div>        


        <br>
        <br>
    </form>









<div id="capaResultadosBusqueda" class="container-fluid"></div>
<div id="capaResultadosEditar" class="container-fluid"></div>

<div id="formularioCrear" class="container-fluid" style="display : none">
<form  id="formularioInsert" action="#" method="POST" >

        
        <div class="row">
           <div class="col-lg-6"> <!-- En una pantalla grande (lg) quiero que se usen 12 columnas para este div -->
               <h2>Nuevo usuario</h2>
               
           </div>
       </div>

       <div class="row">

<!-- Username -->
           <div class="form-group col-lg-4 col-md-12">
               <label for="usuario" > Usuario :</label><br>
                   <input type="text"  name="login"
                   class="form-control usuarioCrear usuario" placeholder="Nombre Usuario" >
                <br>
                
           </div>
            
           

       </div>


<!-- Contraseña -->
       <div class="row">
           <div class="form-group col-lg-4 col-md-12">
               <label for="pass" > Contraseña :</label><br>
                   <input type="text"  name="pass"
                       class="form-control passCrear  pass" placeholder="Contraseña" value="">

           </div>

       </div>

       <!-- Nombre -->

       <div class="row">
           <div class="form-group col-lg-4 col-md-12">
               <label for="nombre" > Nombre</label><br>
                   <input type="text"  name="nombre"
                       class="form-control nombreCrear nombre" placeholder="Nombre" value="">
            </div>
        </div>
        
<!-- Apellido 1 -->
        <div class="row">
           <div class="form-group col-lg-4 col-md-12">
               <label for="apellido1" > Primer apellido</label><br>
                   <input type="text"  name="apellido_1"
                       class="form-control apellido_1Crear apellido_1" placeholder="Primer apellido" value="">
                       </div>
        </div>
<!-- Apellido 2 -->
        <div class="row">
           <div class="form-group col-lg-4 col-md-12">
               <label for="apellido2" > Segundo apellido (Opcional)</label><br>
                   <input type="text"  name="apellido_2"
                       class="form-control apellido_2Crear apellido_2" placeholder="Segundo apellido" value="">
                       </div>
        </div>

<!-- Sexo -->
        <div class="row">
           <div class="form-group col-lg-4 col-md-6">
               <label for="sexo" >Sexo</label><br>
                <select class="form-control sexoCrear sexo" name="sexo">
                    <option></option>
                    <option>H</option>
                    <option>M</option>
                </select>
                   
            </div>
        </div>

<!-- Email  -->

        <div class="row">
           <div class="form-group col-lg-4 col-md-12">
               <label for="E-mail" >Email</label><br>
               <input type="text" id="email" name="mail"
                       class="form-control mailCrear mail" placeholder="E-mail" value="">
                   
            </div>
        </div>

<!-- Movil  -->

<div class="row">
           <div class="form-group col-lg-4 col-md-12">
               <label for="telefono" >Telefono</label><br>
               <input type="text" max-length="9" id="telefono" name="movil"
                       class="form-control movilCrear movil" placeholder="Telefono" value="">
                   
            </div>
        </div>

       <!-- Boton creacion -->

       <div class="row">
            <div class="col-lg-12">
                 <button type="button" onclick="crearUsuario()"
                     class="btn btn-primary">Crear</button>
           
         </div> 
         <br>
         <BR>

        

       </div>

      
       
   </div>

   </div>

   
   
   </form>
   </div>
