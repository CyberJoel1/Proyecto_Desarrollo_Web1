<?php
    //Iniciamos la sesion
    session_start();
    //Validar si se esta ingresando directamente sin logueo
    if(!$_SESSION){
        header("location:index.html");
    }
?>

<?php
include_once "base_de_datos.php";
//Leer los datos del usuario y poderlos visualizar en los input para editarlos
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    $query = 'SELECT * FROM productos WHERE idproducto=?';
    if($stmt = $conn->prepare($query)){
        $stmt -> bind_param('i', $_GET['id']);
        if($stmt -> execute()){
            $result = $stmt->get_result();
            if($result -> num_rows == 1){
				$row = $result -> fetch_array(MYSQLI_ASSOC);
				$id = $_GET['id'];
                $codigo = $row['codigo'];
                $descripcion = $row['descripcion'];
                $precioVenta = $row['precioVenta'];
                $precioCompra = $row['precioCompra'];
                $existencia = $row['existencia'];
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
    header("location: listar_producto.php");
    exit();
}

//Tomar los datos editados y actualizarlos en la base de datos
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['codigo']) && isset($_POST['descripcion']) && isset($_POST['precioVenta']) && isset($_POST['precioCompra']) && isset($_POST['existencia'])){
        $query = "UPDATE productos SET codigo=?, descripcion=?, precioVenta=?, 
        precioCompra=?, existencia=? WHERE idproducto=?";
        if($stmt = $conn->prepare($query)){
            $stmt -> bind_param('sssssi', $_POST['codigo'], $_POST['descripcion'],
            $_POST['precioVenta'], $_POST['precioCompra'], $_POST['existencia'], $_GET['id']);
            if($stmt -> execute()){
                header("location: listar_producto.php");
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
			<h1>Editar producto con el ID <?php echo $id; ?></h1>
			<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
		
				<label for="codigo">Código de barras:</label>
				<input value="<?php echo $codigo ?>" class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">

				<label for="descripcion">Descripción:</label>
				<textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"><?php echo $descripcion ?></textarea>

				<label for="precioVenta">Precio de venta:</label>
				<input value="<?php echo $precioVenta ?>" class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">

				<label for="precioCompra">Precio de compra:</label>
				<input value="<?php echo $precioCompra ?>" class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra">

				<label for="existencia">Existencia:</label>
				<input value="<?php echo $existencia ?>" class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">
				<br><br><input class="btn btn-info" type="submit" value="Guardar">
				<a class="btn btn-warning" href="./listar_producto.php">Cancelar</a>
			</form>
		</div>
	</div>
</div>