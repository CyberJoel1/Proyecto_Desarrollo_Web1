<?php
    //Iniciamos la sesion
    session_start();
    //Validar si se esta ingresando directamente sin logueo
    if(!$_SESSION){
        header("location:index.html");
    }
?>


<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Nuevo Cliente</h1>
			<form method="post" action="nuevo_cliente.php">
				<label for="nombre">Nombre:</label>
				<input class="form-control" name="nombre" required type="text" id="nombre" placeholder="Escriba su nombre">

				<label for="apellido">Apellido:</label>
				<input class="form-control" name="apellido" required type="text" id="apellido" placeholder="Escriba su apellido">

				<label for="cedula">Cedula:</label>
				<input class="form-control" name="cedula" required type="text" id="cedula" placeholder="Cedula">

				<label for="telefono">Telefono:</label>
				<input class="form-control" name="telefono" required type="text" id="telefono" placeholder="Telefono">

				<label for="direccion">Direccion:</label>
				<input class="form-control" name="direccion" required type="text" id="direccion" placeholder="Direccion">
				<br><br><input class="btn btn-info" type="submit" value="Guardar">
			</form>
		</div>
	</div>
</div>