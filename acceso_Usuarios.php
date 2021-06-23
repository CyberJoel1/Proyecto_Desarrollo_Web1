<?php
//Recibir los datos desde el formulario

$user=$_POST['usuario'];
$pass=$_POST['contrasenia'];


if (isset($user)) {
    //Proceso de conexion a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyecto";
    //Crear la conexion
    $conn = mysqli_connect($servername, $username, $password, $dbname) or die ("Error en la conexion");

    //Iniciar sesion+
    session_start();

    //Consultar si los datos son los que estan en la bse
    $consulta = "SELECT * FROM usuarios WHERE usuario = '$user' AND contrasenia = '$pass'";
    //Ejecutar la consulta
    $resultados = mysqli_query($conn, $consulta) or die (mysqli_connect_errno());
    //almacenar los datos de un arreglo
    $fila = mysqli_fetch_array($resultados);

    //controlar si llegan datos
    if($fila['idusuario'] == null){
        //redirigir al fomulario login
        header("location:index.html");
    }else{
        //definimos las variables de sesión y redirigimos a la pagina de usuario
        $_SESSION['idusuario'] = $fila['idusuario'];
        $_SESSION['nombreusuario'] = $fila['nombreusuario'];
        $_SESSION['cedulausuario'] = $fila['cedulausuario'];
        header("location:listar_producto.php");
    }
}else{
    header("location:index.html");
}


?>
