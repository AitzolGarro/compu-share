<?php
    session_start();
    $_SESSION['titulo'] = "Ultimas Publicaciones | Compu-Share";
    include_once "lib_php.php";
    include_once "config.php";
    $SQL = new manejoBD();
    $conexion = $SQL->f_conectar("compushare");
    $nav = $navInicio;
    generarDocumentacion($conexion,$nav);
    //Comprobar si el usuatio tiene la sesion iniciada o no.
    if (isset($_SESSION['sesion']) && $_SESSION['sesion'] == "iniciado") {
        $divLogin = $loginConAuth;
        $nav .= $navAuth;
    } else {
        $divLogin = $loginSinAuth;
        $nav .= $navNoAuth;
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
            <h1 class="entry-title" style="color:black">Últimas publicaciones</h1>
                <img src="images/docu.png" alt="">
            </div>
            <article class="content-1170 center-relative">
            
            <div class="content-wrapper">
                    <div class="entry-content" style="background-color:#2f2f2b">
                        <?php
                            $consulta = "SELECT * FROM categorias join Usuarios on categorias.autor = Usuarios.codUsuario ORDER BY categorias.fCategoria desc;";
                            $resultado = $SQL->f_ejecutar($conexion,$consulta);
                            $tabla = "<span style=\"text-align:center\"><h1>Últimas publicaciones</i></h1></span>"; 
                            $tabla = "<table class=\"Foro\"><thead><tr><th>Nombre</th><th>Fecha de publicación</th><th>Autor</th></tr></thead><tbody>"; 
                        
                            while($fila = $SQL->f_fetch($resultado))
                            {     
                                if ($fila['codCategoria']==1){
                                    continue;
                                }else{
                                    $tabla .= "<tr><td><a href=\"verDocumentacion.php?id=".$fila['codCategoria']."\">".$fila['Titulo']."</td><td>".$fila['fCategoria']."</td><td>".$fila['nomUsuario']."</td></tr>";
                                }          
                            }
                            $tabla.="</tbody></table>";
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
