<?php
    include_once 'conexion.php';

    $sentencia_select=$con->prepare('SELEC *FROM clientes ORDER BY id DESC');
    $sentencia_select->execute();
    $resultado=$sentencia_select->fetchAll();

    //metodo buscar
    if (isset($_POST['btn_buscar'])){
        $buscar_text=$_POST['buscar'];
        $select_buscar=$con->prepare('
            SELECT *FROM clientes WHERE nombre LIKE :campo OR apellidos LIKE :campo;'
    );

    $select_buscar->execute(array(
        ':campo' =>"%".$buscar_text."%"
    ));

    $resultado=$select_buscar->fetchAll();
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">


    <link rel="stylesheet" href="css/estilos.css">
    <title>CRUD</title>
</head>
<body>
    <div class="contenedor">
        <h2>CRUD EN PHP CON MYSQL</h2>
        <div class="barra_buscador">
        <form action="" class="formulario" method="post">
            <input type="text" name="buscar" placeholder="buscar nombre o apellidos"
            value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input_text">
            <input type="submit" class="btn" name="btn_buscar" value="Buscar">
            <a href="insert.php" class="btn btn_nuevo">Nuevo</a>
        </form>
        </div>
        <table>
            <tr class="head">
                <td>Id</td>
                <td>Nombre</td>
                <td>Apellidos</td>
                <td>Telefono</td>
                <td>Ciudad</td>
                <td>Correo</td>
                <td colspan="2">Acción</td>
            </tr>
        <?php foreach($resultado as $fila):?>
        <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['nombre']; ?></td>
            <td><?php echo $fila['apellidos']; ?></td>
            <td><?php echo $fila['telefono']; ?></td>
            <td><?php echo $fila['ciudad']; ?></td>
            <td><?php echo $fila['correo']; ?></td>
            <td><a href="update.php?id=<?php echo $fila['id']; ?>" class="btn_update" >Editar</a></td>
            <td><a href="delete.php?id=<?php echo $fila['id']; ?>" class="btn_delete" >Eliminar</a></td>
        </tr>
        <?php endforeach ?>
        </table>
    </div>
</body>
</html>