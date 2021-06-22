<?php
include "encabezado.php";
?>
<?php
	include_once "base_de_datos.php";
	$query = "SELECT * FROM productos";
    $result = $conn -> query($query);
?>
<div class="container mt-5">
<h2>Lista Productos</h2>
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
	<a class="btn btn-success" >Nuevo <i class="fas fa-highlighter"></i></a>
  </div>
  <?php 
						if($result->num_rows > 0){
							while($row = $result -> fetch_assoc()){
								echo '<tr>';
								echo '<td>' . $row['codigo'] . '</td>';
								echo '<td>' . $row['descripcion'] . '</td>';
								echo '<td>' . $row['precioCompra'] . '</td>';
								echo '<td>' . $row['precioVenta'] . '</td>';
								echo '<td>' . $row['existencia'] . '</td>';
								echo '<td><a class="btn btn-warning" href="editar_producto.php?id=' . $row['idproducto'] .'"><i class="fa fa-edit"></i></a></td>';
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