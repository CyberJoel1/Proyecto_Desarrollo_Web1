<?php
    //Iniciamos la sesion
    session_start();
    //Validar si se esta ingresando directamente sin logueo
    if(!$_SESSION){
        header("location:index.html");
    }
?>
<?php
include_once "Bdd.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['cedula'])
    && isset($_POST['telefono']) && isset($_POST['direccion'])){
        $query = "INSERT INTO clientes (nombre, apellido, cedula, telefono, direccion) VALUES (?,?,?,?,?)";
        if($stmt = $conn->prepare($query)){
            $stmt -> bind_param('sssss', $_POST['nombre'], $_POST['apellido'],
            $_POST['cedula'], $_POST['telefono'], $_POST['direccion']);
            if($stmt -> execute()){
                header("location: listar_cliente.php");
                exit();
            }else{
                echo "Error! por favor intente mas tarde.";
            }
            $stmt -> close();
        }
    }
    $conn -> close();
}
?>

