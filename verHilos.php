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

            <div class="header-image" >
            <h1 class="entry-title" style="color:black">FORO</h1>
                <img src="images/foroInicio.png" alt="">
            </div>
            <article class="content-1170 center-relative">
            
            <div class="content-wrapper">
<?php
        $id=mysqli_real_escape_string($conexion,$_GET['id']);
$sql = "SELECT
            codCategoria,
            nombre,
            descripcion
        FROM
            foroCategorias
        WHERE
            codCategoria = $id;";  
 
$resultado = mysqli_query($conexion,$sql);
 
if(!$resultado)
{
    echo 'No se han podido mostrar los hilos. Porfavor notifique al soporte el siguiente error: '. mysqli_error($conexion);
}
else
{
    if(mysqli_num_rows($resultado) == 0)
    {
        echo 'Esta categoría no existe.';
    }
    else
    {
        while($fila = mysqli_fetch_assoc($resultado))
        {
            
            echo "<span style=\"text-align:center\"><h1>Hilos en la categoría:  <i>".$fila['nombre']."</i></h1></span>";
        }
     
        $sql = "SELECT  
                    codTema,
                    Asunto,
                    fechaCreacion,
                    categoria,
                    nomUsuario
                FROM
                    foroTemas join Usuarios on Usuarios.codUsuario=foroTemas.autor
                WHERE
                    categoria = $id;";
         
        $resultado = mysqli_query($conexion,$sql);
         
        if(!$resultado)
        {
            echo 'No se han podido mostrar los hilos. Lo sentímos.';
        }
        else
        {
            if(mysqli_num_rows($resultado) == 0)
            {
                echo 'No hay hilos en esta categoría.';
            }
            else
            {
                $tabla = "<table class=\"Foro\"><thead><tr><th>Hilo</th><th>Fecha de apertura</th><th>Autor</th></tr></thead><tbody>"; 
                     
                while($fila = mysqli_fetch_assoc($resultado))
                {               
                    $tabla .= "<tr><td><a href=\"respuestas.php?id=$id&hilo=".$fila['codTema']."\">".$fila['Asunto']."</td><td>".$fila['fechaCreacion']."</td><td>".$fila['nomUsuario']."</td></tr>";
                }
                $tabla.="</tbody></table>";
                 echo $tabla;
            }
        }
    }

}

?>
</div>
</article>
</div>

<?php
echo $scripts;
?>
</body>
</html>