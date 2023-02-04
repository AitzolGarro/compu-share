<?php
session_start();
    $_SESSION['titulo'] = "Inicio | Compu-Share";
    require_once "lib_php.php";
    require_once "config.php";
    /*
    $SQL = new manejoBD();
    $conexion = $SQL->f_conectar("compushare");
    $nav = $navInicio;
    generarDocumentacion($conexion,$nav);
    //Comprobar si el usuatio tiene la sesion iniciada o no.
    if($_SESSION["sesion"] != "iniciado")
    { 
    //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión) 
    $_SESSION['errores']= "<b><span style=\"color:red;\">Necesitas iniciar sesión</span></b>";
    header("Location: index.php"); 
    exit(); 
    } else {
        $nav = $navInicio;
      //  generarDocumentacion($conexion,$nav);
        $divLogin = $loginConAuth;
        $nav .= $navAuth;

    }*/
    // Si se a solicitado una instert
    if(isset($_POST['submit'])){

        $titulo = mysqli_real_escape_string($conexion,$_POST['titulo']);
        $codigo = mysqli_real_escape_string($conexion,$_POST['codigo']);
        $padre = $_POST['padre'];



        if($titulo != ''){
            
            //mysqli_query($conexion, "call pr_AgregarCategoria('$titulo','$codigo',$padre,".$_SESSION['codUsuario'].");");
            $url=$_SERVER['HTTP_REFERER'];
		    header("location:$url");
        }
    }
    $padres = "<select name=\"padre\">";
   // f_dropDownDocumentacion($conexion,$padres);
    $padres .= "</select>";
    
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
                <h1 class="entry-title"><span style="color:black">Editor de texto</span></h1>
                <img src="images/editor.jpg" alt="">
            </div>
            <article class="content-1170 center-relative">
                <div class="content-wrapper">
                    <div class="clear"></div>
                    <div class="full-width-content">
                            <form method='post' action=''>
                                  <div stlye="align-self:center">
                                        Título: <input type="text" name="titulo" >
                                        Categoría: <?php echo $padres; ?>
                                  </div>
                                    Artículo: 
                                    <textarea id='codigo' name='codigo' ></textarea><br>
                            
                                    <input type="submit" name="submit" value="Submit">
                                </form>
                                
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
                    </div>
                    
            </article>
        </div>

        <?php
            echo $piePagina;
            echo $scripts;
        ?>
    </body>
</html>
 
