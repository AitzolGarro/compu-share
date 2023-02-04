<?php
    session_start();
    $_SESSION['titulo'] = "Registrate | Compu-Share";

    require_once "lib_php.php";
    require_once "config.php";
    $SQL = new manejoBD();
    $conexion = $SQL->f_conectar("compushare");
    $nav = $navInicio;
    generarDocumentacion($conexion,$nav);
    $nav .= $navNoAuth;
    echo $cabezera;
    $nav .= "</ul></nav>";
    echo $nav;
?>


                
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="content" class="site-content center-relative">
            
            <article class="content-1170 center-relative">
                <div class="content-wrapper" style="align-item:center;text-align:center;">
                    <h1 class="entry-title" style="align-item:center;text-align:center;">
                       REGISTRATE AHORA
                    </h1>
                    <div id="errores">
                        <?php
                            //Muestra los errores
                            if (isset($_SESSION["errores"])) {
                                foreach ($error as $_SESSION["errores"]) {
                                    echo "<span style=\"color:red\"><b>$error</b></span><br />";
                                } 
                                unset($_SESSION['errores']);
                            }
                        ?>
                    </div>
                    <div class="entry-content" style="align-item:center;text-align:left;max-width: 40%;margin: 0 auto; align-self: center">
                        <form action="registro.php" name="procesar" method="POST">
                            <div>
                                <label>Nombre de usuario:</label>
                                <input type="text" placeholder="Usuario" name="Usuario" style="float:right"/>
                            </div>
                            <div> 
                                <label>Correo electrónico:</label>
                                <input type="text" placeholder="Correo electrónico" name="correo" style="float:right"/>
                            </div>
                            <div>
                                <label>Contraseña:</label>
                                <input type="password" placeholder="Contraseña" name="contrasena_1" style="float:right"/>
                            </div>
                            <div>
                                <label>Repita la contraseña:</label>
                                <input type="password" placeholder="Repita la contraseña" name="contrasena_2" style="float:right"/>
                            </div>
                            <div>
                                <input type="submit" name="bt_Registrar" value="Registrarse"style="float:right"/>
                            </div>
                        </form>
                    </div>
                    <script type="text/javascript">
                        function validarEmail(correo) 
                        {
                            var re = /\S+@\S+\.\S+/;
                            return re.test(correo);
                        }
                            var form = document.procesar;
                        document.procesar.onsubmit = function(e){
                            var ready = false;
                            
                            if(form.Usuario.value!="" && form.correo.value!=""&& form.contrasena_1.value!="" && form.contrasena_2.value!=""){
                                ready = true;
                            }else{
                                    ready= false;
                                    alert("Hay algunos campos vacios");
                                    e.preventDefault();			
                            }
                            if(ready){
                                if(validarEmail(form.correo.value)){
                                    if(form.contrasena_1.value==form.contrasena_2.value){
                                        ready = true;
                                    }else{
                                        ready= false;
                                        alert("Las contraseñas no coinciden");
                                        form.contrasena_1.focus();
                                        e.preventDefault();
                                    }		
                                }else {
                                        alert("El correo no tiene un formato valido!");
                                        form.correo.focus();
                                        e.preventDefault();			
                                }
                            }
                        }
                    </script>
            </article>
        </div>


        <?php
            echo $piePagina;
            echo $scripts;
        ?>
    </body>
</html>