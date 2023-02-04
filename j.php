<?php 
include_once "lib_php.php";
include_once "config.php";
$conexion = mysqli_connect("localhost","phpmyadmin","M#rc13l@g0","compushare");

$jeje =generarDocumentacion($conexion);
if  ($jeje) {
    echo "hola";
}else{echo $jeje;}
?>