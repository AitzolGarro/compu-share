
<?php
session_start();
$_SESSION['titulo'] = "Editor | Compu-Share";
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

        <div id="content" class="site-content">

            <div class="header-image" >
            <h1 class="entry-title" style="color:black">EDITOR DE CODIGO</h1>
                <img src="images/desarrolloWeb.png" alt="">
            </div>
            <article class="content-1170 center-relative">
                
            <div class="content-wrapper" style="background-color:#2f2f2b;">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script src="https://ajaxorg.github.io/ace-builds/src/ace.js"></script>
            <script src="https://cloud9ide.github.io/emmet-core/emmet.js"></script>
            <p><span style="color:white">Pulse Ctrl + b para cambiar ajustes del editor</span></p>
            <div id="editor"></div>
            <div id="statusBar" style="color:white">Editando en la posición: </div>
            <h3><span style="color:white;">Previsualización</span></h3>
            <div id="previsualizacion"></div>
            <script src="editorCodigo/ace-builds/src-noconflict/ace.js"></script>
            <script src="editorCodigo/ace-builds/src-noconflict/ext-language_tools.js"></script>
            <script src="editorCodigo/ace/demo/kitchen-sink/require.js"></script>
            <script src="editorCodigo/ace-builds/src/ace.js"></script>
<!-- load ace settings_menu extension -->
<script src="editorCodigo/ace-builds/src/ext-settings_menu.js"></script>
<script src="https://cloud9ide.github.io/emmet-core/emmet.js"></script>
<script src="editorCodigo/ace-builds/src/ext-statusbar.js"></script>
            <script>
        editor = ace.edit("editor", {//Ajustar el diseño del editor
        autoScrollEditorIntoView: true,
        maxLines: 40,
        minLines: 15
      });
    // Habilitar funcionalidades al editor con la API de ACE editor
    editor.setOptions({
        enableBasicAutocompletion: true,
        enableSnippets: true,
        enableLiveAutocompletion: false,
        enableEmmet: true
    });
    var editor = ace.edit("editor");
    ace.require('ace/ext/settings_menu').init(editor);
    editor.setTheme("ace/theme/eclipse");
    editor.session.setMode("ace/mode/html");
    editor.setOption("enableEmmet", true);
    var StatusBar = ace.require("ace/ext/statusbar").StatusBar;
    // create a simple selection status indicator
    var statusBar = new StatusBar(editor, document.getElementById("statusBar"));
	editor.commands.addCommands([{
		name: "showSettingsMenu",
		bindKey: {win: "Ctrl-b", mac: "Ctrl-b"},
		exec: function(editor) {
			editor.showSettingsMenu();
		},
		readOnly: true
	}]);

    function showHTML() {
        $('#previsualizacion').html(editor.getValue());
    }
    
    function visualizarIFRAME() {
        $('#previsualizacion').html("<iframe src=" +
             "data:text/html," + encodeURIComponent(editor.getValue()) +
        "></iframe>");
    }
    editor.on("input", visualizarIFRAME)
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