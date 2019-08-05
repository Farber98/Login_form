<?php 
session_start();

session_destroy();  //Cerramos la sesion.

$_SESSION = array();    //Limpiamos la sesion estableciendola como un arreglo vacio.

header('Location: login.php');  //Redirigimos al login.

?>