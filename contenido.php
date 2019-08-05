<?php   
//Logica. Se encarga de comprobar que el usuario tenga una sesion.
//En caso de no tenerla, mandara al usuario a iniciar sesion o a que se registre.
//Si en verdad tiene una sesion, se cargara el contenido.view.php  
 
session_start();

if ($_SESSION['usuario'])   //Protegemos el contenido.
{
    require 'views/contenido.view.php';  //Si hay sesion, se puede ver el contenido.
}
else
{
    header('Location: login.php');   //Si no hay sesion, se redirige al login.
}
 
 ?>