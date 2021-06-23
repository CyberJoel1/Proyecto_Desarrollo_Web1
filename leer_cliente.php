<?php
include "encabezado.php";
?>
<?php
	include_once "Bdd.php";
	$query = "SELECT * FROM clientes";
    $result = $conn -> query($query);
?>
<div class="container mt-5">
<h2>Lista Clientes</h2>
<table class="table table-hover table-bordered mt-2">
<thead class="thead-dark">
  <tr>
    <th scope="col">Nombre</th>
    <th scope="col">Cedula</th>
    <th scope="col">Telefono</th>
    <th scope="col">Direccion</th>
    <th scope="col">Editar</th>
    <th scope="col">Eliminar</th>
    <th scope="col">Vender</th>
  </tr>
</thead>
<tbody>
  <div >
	<a class="btn btn-success" href="IngresarCliente.php" >Nuevo <i class="fas fa-highlighter"></i></a>


	


  </div>
  <?php 
						if($result->num_rows > 0){
							while($row = $result -> fetch_assoc()){
								echo '<tr>';
								echo '<td>' . $row['nombre'] . " " . $row['apellido'] . '</td>';
                          	  	echo '<td>' . $row['cedula'] . '</td>';
                            	echo '<td>' . $row['telefono'] . '</td>';
								echo '<td>' . $row['direccion'] . '</td>';
								echo '<td><a class="btn btn-warning" href="actualizarCliente.php?id=' . $row['idcliente'] .'"><i class="fa fa-edit"></i></a></td>';
								echo '<td><a class="btn btn-danger" href="eliminar_cliente.php?id=' . $row['idcliente'] .'"><i class="fa fa-trash"></i></a></td>';
								echo '<td><a class="btn btn-info" href="NuevaVenta.php?id=' . $row['idcliente'] .'"><i class="fas fa-cart-plus"></i></a></td>';
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