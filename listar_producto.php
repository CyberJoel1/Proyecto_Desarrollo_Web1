<?php
	//Iniciamos la sesion
	session_start();
	//Validar si se esta ingresando directamente sin logueo
	if(!$_SESSION){
		header("location:index.html");
	}
?>

<?php include_once "encabezado.php" ?>

<?php
	include_once "Bdd.php";
	$query = "SELECT * FROM productos";
    $result = $conn -> query($query);
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Productos</h1>
			<div>
				<a class="btn btn-success" href="./IngresarProducto.php">Nuevo <i class="fa fa-plus"></i></a>
			</div>
			<br>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Código barras</th>
						<th>Descripción</th>
						<th>Precio de compra</th>
						<th>Precio de venta</th>
						<th>Existencia</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
                <tbody>
					<?php 
						if($result->num_rows > 0){
							while($row = $result -> fetch_assoc()){
								echo '<tr>';
								echo '<td>' . $row['codigo'] . '</td>';
								echo '<td>' . $row['descripcion'] . '</td>';
								echo '<td>' . $row['precioCompra'] . '</td>';
								echo '<td>' . $row['precioVenta'] . '</td>';
								echo '<td>' . $row['existencia'] . '</td>';
								echo '<td><a class="btn btn-warning" href="actualizarProducto.php?id=' . $row['idproducto'] .'"><i class="fa fa-edit"></i></a></td>';
								echo '<td><a class="btn btn-danger" href="eliminar_producto.php?id=' . $row['idproducto'] .'"><i class="fa fa-trash"></i></a></td>';
								echo '</tr>';
							}
							$result -> free();
						}else{
							echo '<p><em> No existen datos registrados </em></p>';
						}
					?>
            	</tbody>
			</table>

		</div>
	</div>
</div>