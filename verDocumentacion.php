<?php
    session_start();
    include_once "lib_php.php";
    include_once "config.php";

    $SQL = new manejoBD();
    $conexion = $SQL->f_conectar("compushare");

    $id = mysqli_real_escape_string($conexion,$_GET['id']);
    $consulta = "SELECT * FROM categorias join Usuarios on categorias.autor = Usuarios.codUsuario where codCategoria = $id;";
    $resultado = $SQL->f_ejecutar($conexion,$consulta);
    $fila = $SQL->f_fetch($resultado);
    
    $_SESSION['titulo'] = $fila['Titulo']." | Compu-Share";
    $nav = $navInicio;
    generarDocumentacion($conexion,$nav);
    //Comprobar si el usuatio tiene la sesion iniciada o no.
    if (isset($_SESSION['sesion']) && $_SESSION['sesion'] == "iniciado") {
        $divLogin = $loginConAuth;
        $iniciado = "si";
        $nav .= $navAuth;
    } else {
        $divLogin = $loginSinAuth;
        $iniciado = "no";
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
            <h1 class="entry-title" style="color:black"><?php echo  $fila['Titulo']; ?></h1>
                <input type="hidden" name="inpH_titulo" value="<?php echo  $fila['Titulo']; ?>">
                <img src="images/share.png" alt="">
            </div>
            <article class="content-1170 center-relative">

            <div class="content-wrapper">
                    <div class="entry-content">
                        <?php
                            //Si tiene la sesion iniciada visualizar opciones para cambiar de categoria
                            if ($iniciado == "si") {
                                echo "<form method=\"post\" action=\"solicitudes.php\">";
                                $padres = "<select name=\"padre\" onchange=\"f_visualizarBT()\">";
                                f_dropDownDocumentacionUPD($conexion,$padres,$fila['catPadre']);
                                $padres .= "</select>";
                                echo $padres;
                            }
                        ?>
                         <textarea id='codigo' name='codigo' onchange="f_visualizarBT()" ><?php
                         
                            $salida = htmlentities($fila['HTML']);
                            if($salida){
                            echo $salida;
                         } else{
                             echo "<h1>Esta pagina no contiene información para mostrar</h1>";
                         }
                        ?></textarea>
                        <!-- Script -->
                        <script type="text/javascript">
                        
                            // Inicializar CKEditor
                            ClassicEditor
                                                    .create( document.querySelector( '#codigo' ) )
                                                    .catch( error => {
                                                        console.error( error );
                                                    } );
                                                   
                    
                            CKEDITOR.replace('codigo',{
                    
                                width: "500px",
                                height: "200px"
                       
                            }); 
                            
                        
                            
                        </script>
                        <?php
                        echo "<br/> Artículo publicado por ".$fila['nomUsuario']."<br />";
                        if ($iniciado == "si") {
                            //Visualizar boton para crear solicitud y cerrar formulario
                            echo "<input id=\"bt_Solicitud\" name=\"bt_Solicitud\" type=\"submit\" style=\"display:none\" value=\"Solicitar actualización\">";
                            echo "</form>";
                        }
                        ?>
             <script>
                f_visualizarBT() {
                    document.getElementById("bt_Solicitud").style.display="block";
                }
            </script>                   
</div>
</article>

</div>
        <?php
            echo $piePagina;
            echo $scripts;
        ?>
    </body>
</html>
