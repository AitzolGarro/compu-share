<?php
header("Content-Type: text/html;charset=utf-8");
session_start();
    $_SESSION['titulo'] = "Inicio | Compu-Share";
    require_once "lib_php.php";
    require_once "config.php";
    
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

        <div class="block content-1170 center-relative">
            <div class="blog-holder block center-relative">

                <article id="post-1" class="relative blog-item-holder">
                    <div class="post-thumb thumb-html one_thumb relative">
                        <script>
                            var slider1_speed = "500";
                            var slider1_auto = "true";
                            var slider1_pagination = "true";
                            var slider1_hover = "true";
                        </script>
                        <div class="image-slider-wrapper">
                            <div class="caroufredsel_wrapper">
                                <ul id="slider1" class="image-slider slides center-text">
                                    <li><img src="images/ciberseguridad.jpg" alt=""></li>
                                    <li><img src="images/codigo.jpg" alt=""></li>
                                    <li><img src="images/servidores.jpg" alt=""></li>
                                </ul>
                            </div>
                            <div class="slider1_pagination carousel_pagination left"></div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="post-title-holder one_title absolute">
                        <h2 class="entry-title excerpt">
                            <a href="ultimaPublicacion.php" style="align-content:center;font-size: 50px">
                                Aprende, práctica y comparte  con Compu-Share.</a>
                        </h2>
                        <div class="cat-links">
                            <ul>
                                <li>
                                    <a href="registrate.php">Únete </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear"></div>
                </article>


                <article id="post-2" class="relative blog-item-holder">
                    <div class="only-post-title-holder">
                        <h2 class="entry-title excerpt">
                            <a href="editorCodigo.php">
                              Practica ahora en nuestro editor de codigo a tiempo real
                            </a>
                        </h2>
                        <div class="cat-links">
                            <ul>
                                <li>
                                    <a href="editorCodigo.php">PRACTICA</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear"></div>
                </article>


                <article id="post-3" class="relative blog-item-holder">
                    <div class="post-thumb thumb-image two_third_thumb left">
                        <img src="images/documentacion.jpg" alt="">
                    </div>
                    <div class="post-title-holder one_third_title right">
                        <h2 class="entry-title">
                            <a href="ultimaPublicacion.php">Aprende de nosotros y de nuestra comunidad</a>
                        </h2>
                        <div class="cat-links">
                            <ul>
                                <li>
                                    <a href="ultimaPublicacion.php">Aprende</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                </article>


                <article id="post-4" class="relative blog-item-holder">
                    <div class="post-thumb thumb-image two_third_thumb right">
                        <img src="images/noticias.jpg" alt="">
                    </div>
                    <div class="post-title-holder one_third_title left">
                        <h2 class="entry-title">
                            <a href="noticias.php">
                                No te pierdas las noticias de la actualidad
                            </a>
                        </h2>
                        <div class="cat-links">
                            <ul>
                                <li>
                                    <a href="noticias.php">Noticias</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                </article>


                <article id="post-5" class="relative blog-item-holder">
                    <div class="post-thumb thumb-image one_third_thumb left">
                        <img src="images/foro.jpg" alt="">
                    </div>
                    <div class="post-title-holder two_third_title right">
                        <h2 class="entry-title">
                            <a href="foro.php">
                                Interactua con otros usuarios mediante en foro interno.
                            </a>
                        </h2>
                        <div class="cat-links">
                            <ul>
                                <li>
                                    <a href="foro.php">FORO</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                </article>


                <article id="post-6" class="relative blog-item-holder">
                    <div class="only-post-title-holder">
                        <h2 class="entry-title excerpt">
                            <a href="contacto.html">
                                Contacta con nuestro soporte enviandonos un correo electrónico
                            </a>
                        </h2>
                        <div class="cat-links">
                            <ul>
                                <li>
                                    <a href="contacto.html">CONTACTA</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                </article>


                <article id="post-7" class="relative blog-item-holder">
                    <div class="post-thumb thumb-image two_third_thumb right">
                        <img src="images/comparte.png" alt="">
                    </div>
                    <div class="post-title-holder one_third_title left">
                        <h2 class="entry-title" style="margin-top: 305px;">
                            <a href="editorTexto.php">Escribe y solicita la publicación de tu documentación en nuestra página web.</a>
                        </h2>
                        <div class="cat-links">
                            <ul>
                                <li>
                                    <a href="editorTexto.php">APORTA</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear"></div>
                    
                </article>

            </div>
            <div class="clear"></div>
            <div class="block center-relative center-text">
                <a class="more-posts">Ir al foro.</a>
            </div>
            <div class="clear"></div>
        </div>


        <?php
            echo $piePagina;
            echo $scripts;
        ?>
    </body>
</html>
 