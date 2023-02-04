<?php
session_start();
require "lib_php.php";
require "config.php";
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
            <h1 class="entry-title" style="color:black">FORO</h1>
                <img src="images/foroInicio.png" alt="">
            </div>
            <article class="content-1170 center-relative">
            
            <div class="content-wrapper">
                <?php
                    $codHilo = mysqli_real_escape_string($conexion,$_GET['hilo']);
                    $consulta= "SELECT * FROM foroRespuestas resp join foroTemas hilos on hilos.codTema=resp.rep_tema join Usuarios usu on usu.codUsuario=resp.respondidoPor WHERE resp.rep_tema=$codHilo;";
                    $respuestas = $SQL->f_ejecutar($conexion,$consulta);
                    $respuesta  = $SQL->f_fetch($respuestas);
                    $rdo = $SQL->f_ejecutar($conexion,$consulta);
                    $tabla = "<table class=\"Foro\"><thead><tr><th></th><th>".$respuesta['Asunto']."</th><th></th></tr></thead><tbody>";
                    while ($resp = $SQL->f_fetch($rdo)){
                        $tabla .= "<tr><td><b>".$resp['nomUsuario']."</b><br />Usuario desde: ".$resp['creado']."</td><td>".$resp['contenido']."</td><td>".$resp['fecha']."</td></tr>";
                    }
                    $tabla.="</tbody></table>";
                    echo $tabla;
                ?>
            <form method="post" action="respuestas.php?id=<?php echo $codHilo; ?>">
                <h1>Responder</h1>
                <textarea name="respuesta"></textarea>
                <input type="submit" value="Publicar respuesta" />
            </form>
<?php
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
   

}

else
{
    if(!$_SESSION['sesion'])
    {
        echo 'Necesitas iniciar sesión para responder en cualquier hilo.';
    }
    else
    {
        $contenido = mysqli_real_escape_string($conexion,$_POST['respuesta']);
        $id = mysqli_real_escape_string($conexion,$_GET['id']);

        $sql = "INSERT INTO foroRespuestas (contenido,fecha,rep_tema,respondidoPor) VALUES ('$contenido',NOW(),$id," . $_SESSION['codUsuario'] . ");";
                         
        $resultado = $SQL->f_ejecutar($conexion,$sql);
                         
        if(!$resultado)
        {
            echo 'Tu respuesta no se a publicado. Prueba de nuevo mas tarde, Volver al <a href="verHilos.php?id=' . htmlentities($_GET['id']) . '">hilo</a>.<br/>'. mysqli_error($conexion);
        }
        else
        {
            echo 'Tu respuesta se a publicado correctamente, Volver al <a href="respuestas.php?id=' . htmlentities($_GET['id']) . '">hilo</a>.';
        }
    }
}

            echo $piePagina;
            echo $scripts;

?>