<?php 
//Reutilizamos el diseño de contenido y cambiamos lo ncesario para hacer el registro.
//Se encarga de darle el diseño de la vista al formulario de registro.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Registrate</title>
</head>
<body>
    <div class="contenedor">
        <h1 class="titulo">Registrate</h1>
        <hr class="border"> <!-- Creamos el formulario de registro -->
<!-- Recordar usar funcion htmlspecialchars para evitar la inyeccion de codigo. -->

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" class="formulario" name="login">  <!-- Name para usar javascript -->
            <div class="form-group">
                <i class="icono izquierda fa fa-user"></i><input type="text" name="usuario" class="usuario" placeholder="Usuario"> <!-- fa fa-user es la clase que debemos usar para traer el icono de FortAwesome de usuario. Deben estar al lado las declaraciones para que quede como lo planeado esteticamente. -->
            </div>

            <div class="form-group">
                <i class="icono izquierda fa fa-lock"></i><input type="password" name="password" class="password" placeholder="Contraseña">  <!-- fa fa-lock es el candado-->
            </div>

            <div class="form-group">
                <i class="icono izquierda fa fa-lock"></i><input type="password" name="password2" class="password_btn" placeholder="Repetir contraseña">  <!-- fa fa-arrow es la flecha-->
                <i class="submit-btn fa fa-arrow-right" onclick="login.submit()"></i> <!-- Login es el name del formulario. Lo actualizamos cuando se clickea el boton con codigo JS. -->
            </div>

            <div class="hidden-submit"><input type="submit" tabindex="-1"/></div> <!-- Para poder enviar con el enter. -->
        </form>

        <p class="texto-registrate">
            ¿Ya tienes cuenta?
            <a href="login.php">Iniciar sesion</a>
        </p>
   </div> 
</body>
</html>