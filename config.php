<?php
//Configuracion global
$email = "aitzol@librem.one";
if (!isset($_SESSION['titulo'])) {
    $_SESSION['titulo'] = "Compu-Share";
}



//Elementos HTML
$loginConAuth = "<form style=\"display: inline-block\" method=\"post\" action=\"autenticar.php\">
                    <input type=\"submit\" id=\"bt_CerrarSesion\" name=\"bt_CerrarSesion\" value=\"Cerrar Sesión\"/>
                </form>";
$loginSinAuth = "<form style=\"color:white;display: inline-block\" method=\"post\" action=\"autenticar.php\">
                    <label id=\"txtUsuario\">Usuario:</label>
                    <input type=\"text\" size=\"12\" id=\"inp_usuario\" name=\"inp_usuario\" initial=\"Nombre de usuario\" />
                    <label id=\"txtUsuario\">Contraseña:</label>
                    <input type=\"password\" size=\"12\" id=\"inp_contrasena\" name=\"inp_contrasena\" initial=\"Contraseña\" />
                    <input type=\"submit\" id=\"bt_iniciarSesion\" name=\"bt_iniciarSesion\" value=\"Iniciar Sesión\"/>
                </form>
                <form style=\"display: inline-block\" method=\"post\" action=\"registrate.php\">
                    <input type=\"submit\" id=\"bt_Registro\" name=\"bt_Registro\" value=\"Regístrate\"/>
                </form>";


$cabezera = "<!DOCTYPE HTML>
            <html lang=\"es-ES\">
                <head>
                    <title>".$_SESSION['titulo']."</title>
                    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
                    <meta name=\"description\" content=\"Aprende, practica y comparte\" />
                    <meta name=\"keywords\" content=\"HTML, CSS, JavaScript, PHP\" />
                    <meta name=\"author\" content=\"Aitzol\" />
                    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\">

                    <link rel=\"shortcut icon\" href=\"images/titulo.png\" />
                    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7CPT+Serif:400,700' rel='stylesheet' type='text/css'>
                    <link rel=\"stylesheet\" type=\"text/css\"  href='css/clear.css' />
                    <link rel=\"stylesheet\" type=\"text/css\"  href='css/common.css' />
                    <link rel=\"stylesheet\" type=\"text/css\"  href='css/font-awesome.min.css' />
                    <link rel=\"stylesheet\" type=\"text/css\"  href='css/carouFredSel.css' />
                    <link rel=\"stylesheet\" type=\"text/css\"  href='css/sm-clean.css' />
                    <link rel=\"stylesheet\" type=\"text/css\"  href='estilos.css' />
                    <script src=\"editorDeDocumentos/ckeditor.js\"></script>                    
                    <script src=\"https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js\"></script>
                    <style type=\"text/css\" media=\"screen\">
                        #editor { 
                            top: 0;
                            right: 0;
                            bottom: 0;
                            left: 0;
                        }
                        #previsualizacion {
                            background-color:white;
                        }
                    </style>

                </head>


                <body class=\"about page page-template-default\">
                    <div class=\"doc-loader\"></div>
                    <div class=\"content-1170 header-holder center-relative\">
                        <div class=\"header-logo left\">
                            <a href=\"index.php\">
                                <img src=\"images/logo.png\" alt=\"Compu-Share\">
                            </a>
                            
                        </div>

                        <div class=\"header-menu\">
                            <div class=\"toggle-holder relative\">
                                <div id=\"toggle\">
                                    <div class=\"one\"></div>
                                    <div class=\"two\"></div>
                                    <div class=\"three\"></div>
                                </div>
                            </div>";
                            
                            if (isset($_SESSION['errores'])){
                                $cabezera .= "<div id=\"alertas\" style=\"display:inline-block;max-width:40%;widht:100%;float:left;\">".$_SESSION['errores']."</div>";
                                unset($_SESSION['errores']);
                            }

    $piePagina = "<footer class=\"footer\">
                        <div class=\"content-1170 center-relative\">
                            <ul>
                                <li class=\"left-footer-content\">
                                    © 2019 Todos  los derechos reservados por <a href=\"https://compushare.servebeer.com\" target=\"_blank\">Compu-Share.      <i class=\"fa fa-desktop\"></i></a>
                                </li>
                                <li class=\"center-footer-content\">
                                    <a href=\"index.php\">
                                        <img src=\"images/logo.png\" alt=\"Katt\">
                                    </a>
                                </li>
                                
                                
                            </ul>
                        </div>
                    </footer>
                    <div class=\"fixed scroll-top\">
                        <img src=\"images/back_to_top.png\" alt=\"Ir arriba\">
                    </div>
                    ";
    $scripts = " <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js\" type=\"text/javascript\"></script>
                    <script type=\"text/javascript\" src=\"js/jquery.js\"></script>
                    <script type=\"text/javascript\" src=\"js/jquery.smartmenus.min.js\"></script>
                    <script src=\"node_modules/monaco-editor/min/vs/loader.js\"></script>
                    <script type=\"text/javascript\" src=\"js/queryloader2.min.js\"></script>
                    <script type=\"text/javascript\" src=\"js/jquery.carouFredSel-6.0.0-packed.js\"></script>
                    <script type=\"text/javascript\" src=\"js/jquery.mousewheel.min.js\"></script>
                    <script type=\"text/javascript\" src=\"js/jquery.touchSwipe.min.js\"></script>
                    <script type=\"text/javascript\" src=\"js/jquery.easing.1.3.js\"></script>
                    <script type=\"text/javascript\" src=\"js/jquery.nicescroll.min.js\"></script>
                    <script type=\"text/javascript\" src=\"js/main.js\"></script>";
    $navForo = "<ul  class=\"navForo\" style=\"list-style-type: none; margin: 0;padding: 0;overflow: hidden;background-color: #333;\">
                    <li style=\"float: left;\"><a style=\" display: block;color: white;text-align: center;padding: 14px 16px;text-decoration: none;\" href=\"foro.php\">Inicio</a></li>
                    <li style=\"float: left;\"><a style=\" display: block;color: white;text-align: center;padding: 14px 16px;text-decoration: none;\" href=\"crearCategoria.php\">Crear categoria</a></li>
                    <li style=\"float: left;\"><a style=\" display: block;color: white;text-align: center;padding: 14px 16px;text-decoration: none;\" href=\"crearTema.php\">Crear tema</a></li>
                </ul>";
    $divCrearCat = "<div id=\"crearCat\" style=\"max-width:50%;width:100%;height:100px;padding:10% 20%\">
                        <form method=\"post\" action=\"\">
                            Nombre de la categoría: <input type=\"text\" name=\"cat_nombre\" style=\"float:right\" size=\"40\"/><br/>
                            Descripcion: <input type=\"text\" name=\"cat_descripcion\" style=\"float:right\" size=\"40\" /><br />
                            <input type=\"submit\" name=\"bt_anaCat\" value=\"Añadir categoría\"  style=\"float:right\"/>
                        </form>
                    </div>";


    $navInicio="<nav id=\"header-main-menu\" class=\"big-menu\"><ul class=\"main-menu sm sm-clean\">
                    <li><a href=\"index.php\" class=\"current\">Inicio</a></li>";
    $navAuth="<li><a href=\"ultimaPublicacion.php\">Ultimas publicaciones</a></li>
                    <li><a href=\"editorCodigo.php\">Editor de código</a></li>
                    <li><a href=\"editorTexto.php\">Editor de texto</a></li>
                    <li><a href=\"noticias.php\">Noticias</a></li>
                    <li><a href=\"foro.php\">Foro</a></li>
                ";
    $navNoAuth="    <li><a href=\"ultimaPublicacion.php\">Ultimas publicaciones</a></li>
                    <li><a href=\"editorCodigo.php\">Editor de código</a></li>
                    <li><a href=\"noticias.php\">Noticias</a></li>
                ";
    

    ?>