<?php
    //Iniciamos la sesion
    session_start();
    //Validar si se esta ingresando directamente sin logueo
    if(!$_SESSION){
        header("location:index.html");
    }
?>
<?php
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
	include_once "Bdd.php";
    $query = 'DELETE FROM ventas WHERE idventas=?';
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('i', $_GET['id']);
        if($stmt -> execute()){
			header("location: ListaVenta.php");
            exit();
        }else{
            echo "Error! Revise la conexion a la base de datos";
            exit();
        }
    }
    $stmt -> close();
    $conn -> close();
}else{
    echo "Error! Por favor intente mas tarde";
    exit();
}

?>