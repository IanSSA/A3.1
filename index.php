<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Menu principal</title>
    <?php
    ?>
</head>
<body style="background-color: <?php 
    if (isset($_COOKIE[$color_fondo])){
        echo $_COOKIE[$color_fondo];
    } else {
        echo '#808080'; 
    }

    if(isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
        echo '<div style=" position: absolute; margin-left: 0;">
        <form action="form_login.php" method="post">
            <label for="">Cerrar sesión</label>
                <input type="submit" name="cerrar">
            </form>
        <h1>Sesión iniciada como ' . $_SESSION["usuario"] . '</h1>
        </div>';
    }
    
    ?>;">
    <div id="div">
        <h1><a href="listado_productos.php">Listado de los productos</a></h1> <br>
        <h1><a href="crear_producto.php">Crear un nuevo producto</a></h1>
    </div>
    <h3><a href="form_login.php">Iniciar sesión</a></h3>
</body>
</html>