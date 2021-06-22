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
	$query = "SELECT * FROM clientes";
    $result = $conn -> query($query);
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Clientes</h1>
			<div>
				<a class="btn btn-success" href="./IngresarCliente.php">Nuevo <i class="fa fa-plus"></i></a>
			</div>
			<br>
			<table class="table table-bordered">
				<thead>
					<tr>
					<th>Nombre</th>
                    <th>Cedula</th>
                    <th>Telefono</th>
					<th>Direccion</th>
					<th>Editar</th>
					<th>Eliminar</th>
					<th>Vender</th>
					</tr>
				</thead>
                <tbody>
					<?php 
						if($result->num_rows > 0){
							while($row = $result -> fetch_assoc()){
								echo '<tr>';
								echo '<td>' . $row['nombre'] . " " . $row['apellido'] . '</td>';
                          	  	echo '<td>' . $row['cedula'] . '</td>';
                            	echo '<td>' . $row['telefono'] . '</td>';
								echo '<td>' . $row['direccion'] . '</td>';
								echo '<td><a class="btn btn-warning" href="editar_cliente.php?id=' . $row['idcliente'] .'"><i class="fa fa-edit"></i></a></td>';
								echo '<td><a class="btn btn-danger" href="eliminar_cliente.php?id=' . $row['idcliente'] .'"><i class="fa fa-trash"></i></a></td>';
								echo '<td><a class="btn btn-info" href="nuevo_venta.php?id=' . $row['idcliente'] .'"><i class="fas fa-cart-plus"></i></a></td>';
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