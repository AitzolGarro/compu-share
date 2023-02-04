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
                <h1 class="entry-title"  style="color:black;">FORO</h1>
                <img src="images/foroInicio.png" alt="">
            </div>
            <article class="content-1170 center-relative">
            
            <div class="content-wrapper">
            <?php
                echo $navForo;

             if($_SERVER['REQUEST_METHOD'] != 'POST')
                {
                    if ($_SESSION['privilegios']<=1){
                        echo "No tienes privilegios para crear una categoria. Puedes abrir un hilo en las en la seccion de soporte para realizar una solicitud";
                    } else{
                    echo $divCrearCat;
                    }
                    
                }
                else
                {
                    $MYSQL = new manejoBD();
                    $conexion = $MYSQL->f_conectar("compushare");
                    $categoria = mysqli_real_escape_string($conexion,$_POST['cat_nombre']);
                    $descripcion = mysqli_real_escape_string($conexion,$_POST['cat_descripcion']);
                    $sql = "INSERT INTO foroCategorias (nombre,descripcion) VALUES('$categoria','$descripcion')";
                    $result = $MYSQL->f_ejecutar($conexion,$sql);
                    if(!$result)
                    {
                        echo 'Error' . mysqli_error(). '<a href="../foro.php">Volver</a>';
                    }
                    else
                    {
                        echo 'Nueva categoría añadida satisfactóriamente. <a href="../foro.php">Volver</a>';
                    }
                }
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