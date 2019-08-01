<?php 
//Va ser el primer archivo que la pagina abra, debemos comprobar si el usuario tiene una sesion:
//1)Si no tiene, se lo envia a la pagina de registro o inicio de sesion
//2) Si tiene una sesion, podra acceder al contenido

session_start();    //Para trabajar con sesiones.

if(isset($_SESSION['usuario']))
{
    header('Location: contenido.php');   //Si existe la sesion, lo mandamos al contenido.
}
else
{
    header('Location: registrate.php');  //Si no existe la sesion, debera registrarse para acceder. Tambien podriamos mandarlo de vuelta al login para que inicie sesion.
}

?>