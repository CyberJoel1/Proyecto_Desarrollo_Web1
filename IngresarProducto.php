<?php
    //Iniciamos la sesion
    session_start();
    //Validar si se esta ingresando directamente sin logueo
    if(!$_SESSION){
        header("location:index.html");
    }
?>

<?php include_once "encabezado.php" ?>

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Nuevo producto</h1>
			<form method="post" action="nuevo_producto.php">
				<label for="codigo">Codigo Producto:</label>
				<input class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">

				<label for="descripcion">Descripción:</label>
				<textarea required id="descripcion" name="descripcion" cols="30" rows="5" class="form-control"></textarea>

				<label for="precioVenta">Precio Venta:</label>
				<input class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">

				<label for="precioCompra">Precio Compra:</label>
				<input class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra">

				<label for="existencia">Stock:</label>
				<input class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">
				<br><br><input class="btn btn-info" type="submit" value="Guardar">
			</form>
		</div>
	</div>
</div>