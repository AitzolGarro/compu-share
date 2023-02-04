<?php
    // OBJETIVO: Crear una solicitud de subida de documentación.
    session_start();
    $_SESSION['titulo'] = "Solicitud | Compu-Share";
    include_once "lib_php.php";
    include_once "config.php";
    //Comprobar si el usuatio tiene la sesion iniciada o no.
       //No queremos que accedan al foro sin tener una sesion valida activa
       if($_SESSION["sesion"] != "iniciado")
           { 
           //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión) 
           header("Location: index.php"); 
           exit(); 
           } else {
               $SQL = new manejoBD();
               $conexion = $SQL->f_conectar("compushare");
               $nav = $navInicio;
               generarDocumentacion($conexion,$nav);
               $divLogin = $loginConAuth;
               $nav .= $navAuth;
   
           }
           echo $cabezera;
           $nav .= "</ul></nav>";
           echo $nav;
   ?>
        <div id="login" style="float: right;display: inline-block;max-width: 700px;">
            <?php
                echo $divLogin;
            ?>
        </div>
        <div class="clear"></div>
    </div>
   <div class="clear"></div>
</div>
   
<div id="content" class="site-content"> 
   <div class="header-image">
        <h1 class="entry-title" style="color:black">CREAR SOLICITUD</h1>
        <img src="LINK DE LA IMAGEN" alt="">
   </div>
   <article class="content-1170 center-relative">
   
   <div class="content-wrapper">

        <?php
            //Comprobar que se reciben los datos necesarios
            if(isset($_POST['submit'])){
                /*
                    Usuario solicitante
                    Titulo del artículo
                    Categoría del artículo
                    Contenido del artículo
                */
                    //Control de valores de las variables por si acaso
                        $solicitante = mysqli_real_escape_string($conexion,$_SESSION['codUsuario']);
                        $titulo = mysqli_real_escape_string($conexion,$_POST['titulo']);
                        $categoria = mysqli_real_escape_string($conexion,$_POST['padre']);
                        $articulo = mysqli_real_escape_string($conexion,$_POST['articulo']);

                    //Inicializar algunas variables
                        $errores = array();
                    
                //Insertar en la tabla de solicitudes MAS TARDE CREAR PROCEDIMIENTO PARA LA EVITAR FILTRAR INFORMACION SOBRE LA ARQUITECTURA DE LA BD
                    $consulta = "INSERT INTO solicitudes (solicitante,titulo,categoria,articulo) VALUES ($solicitante,$titulo,$categoria,$articulo);";
                    $resultado = $SQL->f_ejecutar($conexion,$consulta);
                    if($resultado){
                        //Se a creado la solicitud
                        $
                    } else {
                        //No se a creado la solicitud
                        array_push($errores,"No se a podido crear la solicitud.");
                    }
                    

            }
            //Insertar la solicitud
            
            //Terminar el documento HTML
            echo $piePagina;
            echo $scripts;
    
        ?>