<?php
    include_once 'conexion.php';

    if (isset($_POST['guardar'])){
        $nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
        $telefono=$_POST['telefono'];
        $ciudad=$_POST['ciudad'];
        $correo=$_POST['correo'];

        if (!empty($nombre) && !empty($apellidos) && !empty($telefono) && !empty($ciudad) && !empty($correo) ){
            if (!filter_var($correo,FILTER_VALIDATE_EMAIL)){
                echo "<script> alert('Correo no valido');</script>";
            }else{
                $consulta_insert=$con->prepare('INSERT INTO clientes(nombre,apellidos,telefono,ciudad,correo)
                VALUES(:nombre,:apellidos,:telefono,:ciudad,:correo)');
                $consulta_insert->execute(array(
                    ':nombre' =>$nombre,
                    ':apellidos' =>$apellidos,
                    ':telefono' =>$telefono,
                    ':ciudad' =>$ciudad,
                    ':correo' =>$correo
                ));
                header('Location: index.php');
            }
        }else{
            echo "<script> alert('los campos estan vacios');</script>";
        }
        
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/estilos.css">
    <title>NUEVO CLIENTE</title>
</head>
<body>
    <div class="contenedor">
        <h2>CRUD EN PHP CON MYSQL</h2>
        <form action=""  method="post">
            <div class="form-group">
                <input type="text" name="nombre" placeholder="Nombre" class="input_text">
                <input type="text" name="apellidos" placeholder="Apellidos" class="input_text">
            </div>
            <div class="form-group">
                <input type="text" name="telefono" placeholder="Telefono" class="input_text">
                <input type="text" name="ciudad" placeholder="Ciudad" class="input_text">
            </div>
            <div class="form-group">
                <input type="text" name="correo" placeholder="Correo electronico" class="input_text">
            </div>
            <div class="btn_group">
                <a href="index.php" class="btn btn_danger">Cancelar</a>
                <input type="submit" name="guardar" value="Guardar" class="btn btn_primary">
            </div>
        </form>
    </div>
</body>
</html>