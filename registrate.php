<?php 
//Maneja toda la logica del registro. Hace las validaciones. Si pasa todos los controles, el usuario sera agregado a la BD.

session_start();

if (isset($_SESSION['usuario'])) 
{
    header('Location: index.php');  //Si ya hay una sesion activa, no se puede acceder al formulario para registrarse de nuevo.
                                    //Seria ilogico que teniendo un usario activo, pueda crear otro.
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')   //Si los datos se enviaron... 
{
    //filter_var permite curar la variable para que no se pueda inyectar codigo.
    //strtolower hace que los datos se transformen a minusculas para evitar errores de ingreso por el usuario.
    $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING); 
    $password = $_POST['password'];     //Estos datos los estamos pasando desde los inputs. Los "name" tienen
    $password2 = $_POST['password2'];   //que coincidir con los name de los input.


    $errores = '';  //Variable de errores.

    if (empty($usuario) or empty($password) or empty($password2)) //Si alguno de los campos esta vacio... 
    {
        //Concatenamos el error con la variable de errores 
        $errores .= '<li>Por favor rellena todos los datos correctamente</li>'; 
    }
    else    //Si no estan vacios los campos realizamos la conexion con la base de datos.
    {
        try 
        {
            $conexion = new PDO('mysql:host=localhost;dbname=login_practica', 'root', '');

        } catch (PDOException $e)   //Si hay un error de conexion mostramos.
        {
            echo "Error: " . $e->getMessage();
        }

        //Preparamos la consulta que queremos realizar. Limitamos por seguridad para que solo nos traiga 1 registro.
        $statement = $conexion->prepare('SELECT * FROM usuarios WHERE user = :user LIMIT 1');
        //Ejecutamos nuestra consulta pasandole el valor que tomara usuario. En este caso sera igual a lo que reciba por el campo mediante POST.
        $statement->execute(array(':user'=>$usuario));  //Damos el valor del campo mediante POST al placeholder.
        //Nuestra variable $resultado guardara dos posibilidades:
        //1)El registro del usuario repetido
        //2) False si el usuario no esta registrado.
        $resultado = $statement->fetch();

        if ($resultado != false) //Si el registro ya se encuentra en nuestra base de datos mostramos el error.
        {
            $errores .= '<li>El nombre de usuario ya existe</li>';
        }

        
        //A continuacion vamos a hacer un hash de la contraseña. 
        $password = hash('sha512', $password);  //Algoritmo de encriptacion: "sha512". Luego paso el parametro a encriptar.
        $password2 = hash('sha512', $password2);


        if ($password != $password2) //Si las contraseñas no coinciden...
        {
            $errores .= '<li>Las contraseñas no coinciden</li>';
        }
    }
    
    if ($errores == '') //Si la variable errores quedo vacia, entonces no hay errores.
    {
        //Preparamos nuestra consulta para insertar los datos recibidos en la tabla.
        $statement = $conexion->prepare('INSERT INTO usuarios VALUES (null, :user, :pass)');
        $statement->execute(array(':user'=>$usuario, ':pass'=>$password));  //Ejecutamos la consulta y reemplazamos los placeholder.
        header('Location: login.php');  //Redirigimos al login.php para poder ingresar a la pagina.
    }
}

require 'views/registrate.view.php'
?>