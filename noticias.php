<?php
    session_start();
    $_SESSION['titulo'] = "Noticias | Compu-Share";

    include_once "lib_php.php";
    include_once "config.php";
    //Permitimos la visita de la pagina de noticias a todo el publico
    //Comprobar si el usuatio tiene la sesion iniciada o no.
    
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
            <div class="header-image">
                <h1 class="entry-title">Ultimas noticias</h1>
                <img src="images/bannerNoticias.jpg" alt="">
            </div>

            <article class="content-1170 center-relative">
                <?php
                    //Recoger las noticias del único sitio web <b>interesante</b> que he encontrado....
                    $html = "";
                    $url = "https://feeds.feedburner.com/redeszone/redes?format=xml";
                    $xml = simplexml_load_file($url);
                    echo $xml;
                    for($i = 0; $i < 10; $i++){
                        $titulo = $xml->channel->item[$i]->title;
                        $link = $xml->channel->item[$i]->link;
                        $descripcion = $xml->channel->item[$i]->description;
                        $pubDate = $xml->channel->item[$i]->pubDate;
                        //Resolver la url acortada para obtener la que esta en la descripcion
                        $link = f_resolverDestinoFinal($link);
                        //Remover rastros de la fuente original
                        $descripcion = str_replace("El artículo <a rel=\"nofollow\" href=\"$link\">$titulo</a> se publicó en <a rel=\"nofollow\" href=\"https://www.redeszone.net\">RedesZone</a>.","",$descripcion,$numPosts); 
                        $html .= "<h3><span style='color:white'>$titulo</span></h3>";
                        $html .= "<span style='color:white'>$descripcion</span>";
                        $html .= "<br /><br /><span style='color:white'>$pubDate</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='$link'>Fuente de información</a><hr />";
                    }
                    echo $html;
                ?>
            </article>
        </div>

        <?php
            echo $piePagina;
            echo $scripts;
        ?>
    </body>
</html>
