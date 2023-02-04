<?php
//EN ESTA PAGINA SE REALIZA LA AUTENTICACION DEL USUARIO EN LA BASE DE DATOS
session_start();
require "lib_php.php";
//Si recibe los dos parametros de autenticacion se realizara el intento de inicio de sesion.
if (isset($_POST['bt_iniciarSesion']))
{
    //Creamos el objeto manejador de la BD
    $SQL = new manejoBD();
	//Medidas de seguriad para el robo de contraseñas en caso de ataques a la base de datos
		$contrasena = hash("md5", $_POST['inp_contrasena']);
		$salida;
		//Almacenamos la conexion en una variable
		$conexion = $SQL->f_conectar("compushare");

		
		//Medidas de seguridad para las injecciones SQL
		$usuario = mysqli_real_escape_string($conexion,$_POST['inp_usuario']);

		//Definicion de la consulta
		$cons_Autenticar = "CALL pr_autenticacion('".$usuario."','".$contrasena."',@p_salida,@p_codigo);";
		$cons_Salida = "select @p_salida,@p_codigo";

    
	//Autenticación de usuario
	$rdo1=$SQL->f_ejecutar($conexion,$cons_Autenticar);
	$rdo2=$SQL->f_ejecutar($conexion,$cons_Salida);
	$salida = mysqli_fetch_array($rdo2);
	

	//Bloque de evaluacion de la salida
	if ($salida[0] == -1) { //El usuario no existe
		$_SESSION['errores']= "<b><span style=\"color:red;\">Usuario inexistente</span></b>";
		$_SESSION['numIntentos']=0;
		$url=$_SERVER['HTTP_REFERER'];
		header("location:$url");
	
	}
	else if ($salida[0] == -2) { //El usuario esta bloqueado
			$_SESSION['errores']= "<b><span style=\"color:red;\">Bloqueo de seguridad</span></b>";
			$_SESSION['numIntentos']=0;
			$url=$_SERVER['HTTP_REFERER'];
			header("location:$url");
		
	}
	/*
		 SELECT TIMESTAMPDIFF(HOUR,bloqueo,NOW()),TIMESTAMPDIFF(MINUTE,bloqueo,NOW()),codUsuario,BINARY contrasena = p_contrasena into horas,minutos,p_codigo,contra from Usuarios where nomUsuario = p_usuario;
	*/
	else if ($salida[0] == -3) { //El usuario ha introducido unas credenciales no válidas
		$_SESSION['numIntentos']++;
        if ($_SESSION['numIntentos']<5) {
			$_SESSION['errores']= "<b><span style=\"color:red;\">Credenciales incorrectas. Intentos: ".(5-$_SESSION['numIntentos'])."</span></b>";
            $url=$_SERVER['HTTP_REFERER'];
            header("location:$url");
        }
		else {//Medidas de seguridad de ataques de fuerza bruta
			$_SESSION['numIntentos']=0;
			$consulta = "UPDATE Usuarios SET bloqueo  = NOW() WHERE codUsuario = ".$salida[1].";";
			$blo= $SQL -> f_ejecutar($conexion,$consulta);
			$_SESSION['errores']= "<b><span style=\"color:red;\">Bloqueo de seguridad</span></b>";
			$url=$_SERVER['HTTP_REFERER'];
			header("location:$url");
		}
	}
	else if ($salida[0] == 1) { 
		//Comprobar si el usuario sigue bloqueado
		$conBloque = "CALL `pr_comprobarBloqueo`(".$salida[1].", @salida);";
		$conSalida = "select @salida";
		$resultado = $SQL->f_ejecutar($conexion,$conBloque);
		$salidaBloqueo = $SQL->f_ejecutar($conexion,$conSalida);
		$bloqueos =mysqli_fetch_array($salidaBloqueo);
		if ($bloqueos[0] == 1){//Si sigue bloqueado
			$_SESSION['errores']= "<b><span style=\"color:red;\">Bloqueo de seguridad</span></b>";
			$url=$_SERVER['HTTP_REFERER'];
			header("location:$url");
		} else{//Si el bloqueo ha expirado
			$_SESSION['sesion']="iniciado";
			$_SESSION['numIntentos'] = 0;
			$_SESSION['privilegios'] = 1;
			$_SESSION['codUsuario'] = $salida[1];
			$_SESSION['errores']= "<b><span style=\"color:green;\">Bienvenid@</span></b>";
			$url=$_SERVER['HTTP_REFERER'];
			header("location:$url");
		}
	}
	else {
		$_SESSION['errores']= "<b><span style=\"color:red;\">Algo salió mal</span></b>";
		$url=$_SERVER['HTTP_REFERER'];
		header("location:$url");
	}
} 
// Si el usuario quiere cerrar la sesion
else if (isset($_POST['bt_CerrarSesion'])) {
		session_destroy();
		$url=$_SERVER['HTTP_REFERER'];
		header("location:$url");
}
//Si no recibimos ninguna variable de sesion:
else{
	echo "<b>¿Aun no has inicado sesión?</b><br /><a href='../index.php'>Click aqui para volver a intentarlo</a>";
}



?>