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
<?php
	include_once "Bdd.php";
	$query = "SELECT * FROM productos";
    $result = $conn -> query($query);
?>

<?php
	include_once "Bdd.php";
	$query = "SELECT * FROM productos_vendidos";
    $result = $conn -> query($query);
?>


<?php
	include_once "Bdd.php";
	$query = "SELECT * FROM ventas";
    $result = $conn -> query($query);
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Ventas Realizadas</h1>
			
			<br>
			
			<table class="table table-bordered">
				<thead>
					<tr>
                    <th>Fecha</th>
					<th>Id cliente</th>
                    <th>Id Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Eliminar Venta</th>
					</tr>
				</thead>
                <tbody>
					<?php 
						if($result->num_rows > 0){
							while($row = $result -> fetch_assoc()){
                                echo '<tr>';
                                echo '<td>' . $row['fecha'] . '</td>';
                                echo '<td>' . $row['idcliente'] . '</td>';
                          	  	echo '<td>' . $row['idproducto'] . '</td>';
                            	echo '<td>' . $row['cantidad'] . '</td>';
                                echo '<td>' . $row['total'] . '</td>';
								echo '<td><a class="btn btn-danger" href="eliminar_venta.php?id=' . $row['idventas'] .'"><i class="fa fa-trash"></i></a></td>';
								echo '</tr>';
							}
							$result -> free();
						}else{
							echo '<p><em> No existe venta realizada</em></p>';
						}
						
					?>
            	</tbody>
			</table>

		</div>
	</div>
</div>