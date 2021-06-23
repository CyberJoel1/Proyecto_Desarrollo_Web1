
<?php 
include_once "Bdd.php";

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['nombreusuario']) && isset($_POST['cedulausuario'])
    && isset($_POST['usuario'])&& isset($_POST['contrasenia'])){
        $query = "INSERT INTO usuarios (nombreusuario, cedulausuario,
        usuario, contrasenia) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($query)){
            $stmt -> bind_param('ssss', $_POST['nombreusuario'], $_POST['cedulausuario'],
            $_POST['usuario'], $_POST['contrasenia']);
            if($stmt -> execute()){
                header("location: index.html");
                exit();
            }else{
                echo "Error! Por favor intente más tarde";
            }
            $stmt -> close();
        }
    }
    $conn -> close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6d4c14e273.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles-admi.css">    
    <title>ESPE</title>
</head>
<body>
     <!----FORMULARIO REGISTRO --->
 <br><br>
 <form class="formulario" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <h1>Regístrate</h1>
    <div class="contenedor">

        <div class="input-contenedor">
            <i class="fas fa-user icon"></i>
            <input type="text" placeholder="Nombre completo" required id="nombreusuario" name="nombreusuario">
        </div>
        
        <div class="input-contenedor">
            <i class="fas fa-address-card icon"></i>
            <input type="text" placeholder="Cedula" required id="cedulausuario" name="cedulausuario">
        </div>
        
        <div class="input-contenedor">
            <i class="fas fa-user-tie icon"></i>
            <input type="text" placeholder="Usuario" required id="usuario" name="usuario">
        </div>
        
        <div class="input-contenedor">
            <i class="fas fa-key icon"></i>
            <input type="password" placeholder="Contrasenia"  required id="contrasenia" name="contrasenia">
        </div>
        <tr>
        
        <td colspan="2" style="text-align: center;"><input type="submit" value="Registrate" class="button" id="registrar"  name="submit"></td>
        </tr>
        
     </div> 
     <div class="registro">
        <p> Al registrarte, aceptas todas las Condiciones de uso y Politicas de privacidad.</p>
        <p> ¿Ya tienes una cuenta? <a class="link" href="index.html">Iniciar Sesion</a></p>
</div>
</form>
</body>
</html>
