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
//Leer los datos del usuario y poderlos visualizar en los input para editarlos
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    $query = 'SELECT * FROM clientes WHERE idcliente=?';
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('i', $_GET['id']);
        if($stmt -> execute()){
            $result = $stmt->get_result();
            if($result -> num_rows == 1){
				$row = $result -> fetch_array(MYSQLI_ASSOC);
                $nombre = $row['nombre'];
                $apellido = $row['apellido'];
                $cedula = $row['cedula'];
                $telefono = $row['telefono'];
                $direccion = $row['direccion'];
            }else{
                echo 'Error! No existen resultados';
                exit();
            }
        }else{
            echo 'Error! Revise la conexion con la base de datos';
            exit();
        }
        $stmt -> close();
    }
}else{
    header("location: listar_cliente.php");
    exit();
}

//Tomar los datos editados y actualizarlos en la base de datos
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['cedula']) && isset($_POST['telefono']) && isset($_POST['direccion'])){
        $query = "UPDATE clientes SET nombre=?, apellido=?, cedula=?, 
        telefono=?, direccion=? WHERE idcliente=?";
        if($stmt = $conn->prepare($query)){
            $stmt -> bind_param('sssssi', $_POST['nombre'], $_POST['apellido'],
            $_POST['cedula'], $_POST['telefono'], $_POST['direccion'], $_GET['id']);
            if($stmt -> execute()){
                header("location: listar_cliente.php");
                exit();
            }else{
                echo "Error! por favor intente mas tarde.";
                exit();
            }
            $stmt -> close();
        }
    }
    $conn -> close();
}
?>


<link rel="stylesheet" href="css/estilos1.css">
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Editar cliente</h1>
			<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">

				<label for="nombre">Nombre:</label>
				<input value="<?php echo $nombre ?>" class="form-control" name="nombre" required type="text" id="nombre" placeholder="Escribe su nombre">

				<label for="apellido">Apellido:</label>
				<input value="<?php echo $apellido ?>" class="form-control" name="apellido" required type="text" id="apellido" placeholder="Escribe su apellido">

				<label for="cedula">Cedula:</label>
				<input value="<?php echo $cedula ?>" class="form-control" name="cedula" required type="text" id="cedula" placeholder="Cedula">

				<label for="telefono">Telefono:</label>
				<input value="<?php echo $telefono ?>" class="form-control" name="telefono" required type="text" id="telefono" placeholder="Telefono">

				<label for="direccion">Direccion:</label>
				<input value="<?php echo $direccion ?>" class="form-control" name="direccion" required type="text" id="direccion" placeholder="Direccion">
				<br><br><input class="btn btn-info" type="submit" value="Guardar">
				<a class="btn btn-warning" href="./listar_cliente.php">Cancelar</a>
			</form>
		</div>
	</div>
</div>