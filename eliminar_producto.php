
<?php

if(isset($_GET['id']) && !empty(trim($_GET['id']))){
	include_once "base_de_datos.php";
    $query = 'DELETE FROM productos WHERE idproducto=?';
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('i', $_GET['id']);
        if($stmt -> execute()){
			header("location: listar_producto.php");
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