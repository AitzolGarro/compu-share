<?php
    session_start();
    $_SESSION['titulo'] = "Foro | Compu-Share";
    include_once "lib_php.php";
    include_once "config.php";
    //Comprobar si el usuatio tiene la sesion iniciada o no.
    //No queremos que accedan al foro sin tener una sesion valida activa
    if($_SESSION["sesion"] != "iniciado")
        { 
        //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión) 
        $_SESSION['errores']= "<b><span style=\"color:red;\">Necesitas iniciar sesión</span></b>";
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
            <h1 class="entry-title" style="color:black">FORO</h1>
                <img src="images/foroInicio.png" alt="">
            </div>
            <article class="content-1170 center-relative">
            
            <div class="content-wrapper">
            <?php
                echo $navForo;

                $consulta = "select * from foroCategorias;";
                

                $resultado = $SQL->f_ejecutar($conexion,$consulta);
                $tabla = "<div id=\"contenedor\">
                <div id=\"titulo1\" style=\"display:inline-block;background-color: lightgrey;max-width:50%;width:100%;text-align:center;\"><b>Categoría</b></div><div id=\"titulo2\" style=\"display:inline-block;background-color: lightgrey;max-width:50%;width:100%;text-align:center;\"><b>Ultimo hilo</b></div>
                    <div id=\"lista\" style=\"background-color: white;max-width:100%;width:100%;height:auto; overflow:hidden;\" >";
                while ($fila = $SQL->f_fetch($resultado)){
                    $conshilo = "SELECT * FROM foroTemas join foroCategorias on foroTemas.categoria = foroCategorias.codCategoria join Usuarios on Usuarios.codUsuario = foroTemas.autor where foroCategorias.codCategoria = ".$fila["codCategoria"]." order by foroTemas.fechaCreacion DESC";
                    $hilo = $SQL->f_fetch($SQL->f_ejecutar($conexion,$conshilo));
                    $tabla .= "<div id=\"categoria\" style=\"display:inline-block;border: 2px solid white;max-width:49%;width:100%;height:80px;background-color: lightgrey;\">
                    <a href=\"verHilos.php?id=".$fila['codCategoria']."\"><b>".$fila['nombre']."</b></a><br /><span style=\"padding:0 15%;\">".$fila['descripcion']."</span></div>
                        <div id=\"ultimoHilo\" style=\"float:right;display:inline-block;border: 2px solid white;max-width:50%;width:100%;height:80px;background-color: lightgrey;\"><a href=\"respuestas.php?id=".$hilo["codCategoria"]."&hilo=".$hilo['codTema']."\">".$hilo['Asunto']."   </a><span style=\"float:right\">Autor: ".$hilo['nomUsuario']."</span> <br/> Fecha: ".$hilo['fechaCreacion']."</div>";
                }
                $tabla .= "</div></div>";
                echo $tabla;
            ?>
          
            </div>
            </article>
        </div>

        <?php
            echo $piePagina;
            echo $scripts;
        ?>
    </body>
</html>
