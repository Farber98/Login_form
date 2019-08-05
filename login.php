<?php
session_start();
$errores = '';
if (isset($_SESSION['usuario']))    //Comprobamos si hay una sesion activa.
{
    header('Location: index.php');   //En caso de haberla, redirigimos al index.php
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);   //Limpiamos la variable.
    $password = $_POST['password'];
    $password = hash('sha512', $password);

    try 
    {
        $conexion = new PDO('mysql:host=localhost;dbname=login_practica', 'root', '');

    } catch (PDOException $e)   //Si hay un error de conexion mostramos.
    {
        echo "Error: " . $e->getMessage();
    }
    //Consulta donde tiene que coincidir lo pasado por POST con lo que hay en la base de datos.
    $statement = $conexion->prepare('SELECT * FROM usuarios WHERE user = :usuario AND pass = :password');   

    $statement->execute(array(':usuario'=> $usuario, ':password'=> $password)); //Pasamos los placeholder

    $resultado =$statement->fetch();    //Devuelve false si falla, sino devuelve los datos.

    if($resultado !== false)    //Si el resultado no es false es porque nuestra consulta fue correcta.
    {
        $_SESSION['usuario'] = $usuario;    //Creamos la sesion con el nombre usuario.
        header('Location: index.php');      //Redirigimos al usuario al contenido.
    }
    else {
        $errores .= '<li>Datos incorrectos</li>';
    }
}
require 'views/login.view.php'
?>