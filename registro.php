<?php
include "lib_php.php";
 
session_start();

// Registro del nuevo usuario
if (isset($_POST['bt_Registrar'])) {
  // Inicializacion de variables

    $Usuario = "";
    $correo    = "";
    $errores = array(); 
    $MYSQL = new manejoBD();
    $conexion = $MYSQL->f_conectar("compushare");

  // Medidas de seguridad
    $Usuario = mysqli_real_escape_string($conexion, $_POST['Usuario']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contrasena_1 = mysqli_real_escape_string($conexion, $_POST['contrasena_1']);
    $contrasena_2 = mysqli_real_escape_string($conexion, $_POST['contrasena_2']);


  // Validación del formulario
    if (empty($Usuario)) { array_push($errores, "El usuario es necesario"); }
    if (empty($correo)) { array_push($errores, "El correo es necesario"); }
    if (empty($contrasena_1)) { array_push($errores, "Porfavor introduzca una contraseña"); }
    if ($contrasena_1 != $contrasena_2) {
        array_push($errores, "Las contraseñas no coinciden");
    }

  // Comprobacion para evitar nombres de usuario duplicados
  $consulta = "SELECT * FROM usuarios WHERE nomUsuario='$Usuario' OR correo='$correo' LIMIT 1";
  $resultado = $MYSQL->f_ejecutar($conexion, $consulta);
  $fila = mysqli_fetch_assoc($result);
  
  if ($fila) { // El usuario existe:
    if ($fila['Usuario'] === $Usuario) {
      array_push($errores, "Este nombre de usuario ya existe");
    }

    if ($fila['correo'] === $correo) {
      array_push($errores, "Este correo electrónico ya tiene una cuenta asociada");
    }
  }

  // Comprobar si hay errores
  if (count($errores) == 0) {
    $contrasena = hash("md5", $_POST['contrasena_1']);//Usamos el algoritmo de encriptacion md5 para la seguridad de las
                                                      //contraseñas en nuestra base de datos.

    //Proceso de asignacion de codigo de usuario
        //Coprobar si hay huecos entre nuestros codigos
            $comprobar = "call pr_recibirCodigos();";
            $codigos = $MYSQL->f_ejecutar($conexion,$comprobar);
            $codigo = $MYSQL->f_fetch($codigos);
            $codigo = $codigo["codigo"];
            $SQL = new manejoBD();
    $con = $SQL->f_conectar("compushare");
            //Reconectar a la base de datos
    $registro = "CALL pr_registro($codigo, '$Usuario', '$correo', '$contrasena');";
  $registrado = $MYSQL-> f_ejecutar($con, $registro);
      if($registrado){
        $_SESSION['Usuario'] = $Usuario;
        $_SESSION['exito'] = "Te has registrado satisfactóriamente.";
        header('location: ../index.php');
      }else {
        $_SESSION['errores'] = "<span style=\"color:red\">Fallo al realizar el registro.</span>";
        header('location: ../registrate.php');
    }

  
  }
  else {
      $_SESSION['errores'] = $errores;
      header('location: ../registrate.php');
  }

}
?>
