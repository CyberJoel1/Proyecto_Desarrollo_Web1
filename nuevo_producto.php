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
    if(isset($_POST['codigo']) && isset($_POST['descripcion']) && isset($_POST['precioVenta'])
    && isset($_POST['precioCompra']) && isset($_POST['existencia'])){
        $query = "INSERT INTO productos (codigo, descripcion, precioVenta,precioCompra, existencia) VALUES (?,?,?,?,?)";
        if($stmt = $conn->prepare($query)){
            $stmt -> bind_param('sssss', $_POST['codigo'], $_POST['descripcion'],
            $_POST['precioVenta'], $_POST['precioCompra'], $_POST['existencia']);
            if($stmt -> execute()){
                header("location: listar_producto.php");
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







