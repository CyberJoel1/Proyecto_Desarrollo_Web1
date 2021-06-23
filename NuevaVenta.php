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
	$query = "SELECT * FROM productos";
	$result = $conn -> query($query);
	
	date_default_timezone_set('America/Guayaquil');
	$fecha = date("Y-m-d H:i:s"); 
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
                $idcliente = $row['idcliente'];
            }else{
                echo 'Error! No existen resultados';
                exit();
            }
        }else{
            echo 'Error! Revise la conexion con la base de datos';
            exit();
        }
    }
}else{
    header("location: listar_cliente.php");
    exit();
}


//INGRESO DE VENTA PARA LA TABLA DE VENTAS 
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['idcliente']) && isset($fecha) && isset($_POST['idproducto']) 
	&& isset($_POST['cantidad']) && isset($_POST['total'])){
        $query2 = "INSERT INTO ventas (idcliente, fecha, idproducto, cantidad, total) VALUES (?,?,?,?,?)";
        if($stmt = $conn->prepare($query2)){
            $stmt -> bind_param('sssss', $_POST['idcliente'], $fecha, $_POST['idproducto'], $_POST['cantidad'], $_POST['total']);
            if($stmt -> execute()){
                header("location: listar_venta.php");
                exit();
            }else{
                echo "Error! por favor intente mas tarde.";
            }
            $stmt -> close();
        }
    }
}


?>

<?php include_once "encabezado.php" ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Nueva Venta</h1>
			<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">

				<label for="fecha">Fecha:</label>
				<input type="datetime" class="form-control" name="fecha" value="<?= $fecha?>">

				<label for="idcliente">Id Cliente:</label>
				<input type="text" class="form-control" name="idcliente" value="<?php echo $idcliente ?>">

				<label for="idproducto">Id Producto:</label>
				<input class="form-control" name="idproducto" required type="text" id="idproducto" placeholder="ID del producto">

				<label for="cantidad">Cantidad:</label>
				<input class="form-control" name="cantidad" required type="text" id="cantidad" placeholder="Cantidad">

				<label for="precioVenta">Precio de Venta:</label>
				<input class="form-control" name="precioVenta" required type="text" id="precioVenta" placeholder="Ingrese el precio">

				<label for="total">Total venta:</label>
				<input class="form-control" name="total" required type="text" id="total" placeholder="Total">
                <br><br><input class="btn btn-info" type="submit" value="Guardar">
                <a class="btn btn-warning" href="./ListaVenta.php">Cancelar</a>
			</form>
		</div>
	</div>
</div>
<br>
<br>

<?php
	include_once "Bdd.php";
	$query = "SELECT * FROM productos";
    $result = $conn -> query($query);
?>


<div class="container">
	<div class="row">
		<div class="col-xs-12">
        <h1>_______________________________________________________________________________________________</h1>
			<h1>Lista de Productos</h1>
			<br>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>ID Producto</th>
						<th>Codigo de barras</th>
						<th>Descripción</th>
						<th>Precio de venta</th>
					</tr>
				</thead>
                <tbody>
					<?php 
						if($result->num_rows > 0){
							while($row = $result -> fetch_assoc()){
								echo '<tr>';
								echo '<td>' . $row['idproducto'] . '</td>';
								echo '<td>' . $row['codigo'] . '</td>';
								echo '<td>' . $row['descripcion'] . '</td>';
								echo '<td>' . $row['precioVenta'] . '</td>';
							}
							$result -> free();
						}else{
							echo '<p><em> No existen datos registrados </em></p>';
						}
					?>
            	</tbody>
			</table>
		<h1>_______________________________________________________________________________________________</h1>
		</div>
	</div>
</div>

<br>
<br>
<br>