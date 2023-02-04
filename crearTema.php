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
<h1 class="entry-title" style="color:black">ABRIR HILO</h1>
<img src="images/foroInicio.png" alt="">
</div>
<article class="content-1170 center-relative">

<div class="content-wrapper">
    <?php
        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {   
          
            $sql = "SELECT
                        codCategoria,
                        nombre,
                        descripcion
                    FROM
                        foroCategorias";
             
            $resultado = mysqli_query($conexion,$sql);
             
            if(!$resultado)
            {
                echo 'Error while selecting from database. Please try again later.';
            }
            else
            {
                if(mysqli_num_rows($resultado) == 0)
                {
                    if($_SESSION['privilegios'] <= 1)
                    {
                        echo 'No has creado ninguna categoría.';
                    }
                    else
                    {
                        echo 'Antes de poder crear temas. Tendrás que esperar a que el administrador crea una categoría';
                    }
                }
                else
                {
             
                    echo '<form method="post" action="">
                        Asunto: <input type="text" name="asunto" />
                        Categoría:'; 
                     
                        $categorias = "<select name=\"sel_categoria\">";
                        f_dropDownDocumentacion($conexion,$categorias);
                        $categorias .= "</select>";

                        echo $categorias;
                         
                    echo 'Mensaje: <input type="text" name="contenido" size="50" />
                        <input type="submit" value="Crear Tema" />
                     </form>';
                }
            }
        }
        else
        {
            $SQL = new manejoBD();
            $conexion = $SQL->f_conectar("compushare");
          
            $query  = "START TRANSACTION;";
            $result = mysqli_query($conexion,$query);
             
            if(!$result)
            {
                echo 'An error occured while creating your topic. Please try again later.';
            }
            else
            {

                $asunto = mysqli_real_escape_string($conexion,$_POST['asunto']);
                $categoria =mysqli_real_escape_string($conexion,$_POST['sel_categoria']);
                
                $sql = "INSERT INTO 
                            foroTemas(Asunto,
                                   fechaCreacion,
                                   categoria,
                                   autor)
                       VALUES('$asunto',
                                   NOW(),
                                   '$categoria',
                                   " . $_SESSION['codUsuario'] . "
                                   )";
                          
                $result = mysqli_query($conexion,$sql);
                if(!$result)
                {
                    echo 'Error al insertar los datos .' . mysqli_error($conexion);
                    
                    $sql = "ROLLBACK;";
                    $result = mysqli_query($conexion,$sql);
                }
                else
                {
                    
                    $topicid = mysqli_insert_id($conexion);
                     
                    $sql = "INSERT INTO
                                foroRespuestas(contenido,
                                      fecha,
                                      rep_tema,
                                      respondidoPor)
                            VALUES
                                ('" . mysqli_real_escape_string($conexion,$_POST['contenido']) . "',
                                      NOW(),
                                      " . $topicid . ",
                                      " . $_SESSION['codUsuario'] . "
                                )";
                    $result = mysqli_query($conexion,$sql);
                     
                    if(!$result)
                    {
                        echo 'An error occured while inserting your post. Please try again later.' . mysqli_error($conexion);
                        $sql = "ROLLBACK;";
                        $result = mysqli_query($conexion,$sql);
                    }
                    else
                    {
                        $sql = "COMMIT;";
                        $result = mysqli_query($conexion,$sql);
                         
                        echo 'You have successfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
                    }
                }
            }
        }
        echo $piePagina;
        echo $scripts;
    
            ?>