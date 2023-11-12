<!DOCTYPE html>  
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="edita_producto.css">
        <title>Eliminar producto</title>
    </head>
    <body>
        <?php 
        //Conexión, siempre se produce al inicio.
        $servername = "localhost";
        $username = "mitiendaonline";
        $password = "mitiendaonline";
        $db = "mitiendaonline";
        session_start();

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }        
        ?>
        <!--Si el usuario hizo click en Eliminar:-->
        <?php if(isset($_POST["idBorrado"])): ?> 
        <?php
        $borrado = "DELETE FROM productos WHERE id=".$_POST["idBorrado"];
        if (mysqli_query($conn,$borrado)){
            echo "<h2>Producto eliminado correctamente</h2>";
            echo "<h3><a href='listado_productos.php'>Volver al listado</a></h3>";
        } else{
            echo "Error: " . $borrado . "<br>" . mysqli_error($conn);
        }
        ?>
        <!--Si el usuario accedió a elimina_producto.php desde el índice:-->
        <?php elseif(empty($_GET)): ?>
        <h1>ID no encontrada, seleccione el producto a eliminar:</h1>
        <form action="elimina_producto.php" method="get">
            <select name="id_eliminar">
                <?php
                $datos = "SELECT id, nombre FROM PRODUCTOS;";
                if ($result = $conn->query($datos)){
                    while ($row = $result->fetch_assoc()){
                        $id = $row["id"];
                        $Nombre = $row["nombre"];
                        echo "<option value=$id>$Nombre</option>";
                    }
                }
                ?>
            </select>
            <button type="submit" class="submit btn btn-primary mt-3" onclick="crear_productos()">Enviar</button>
        </form>
        <!--Si el usuario seleccionó el producto a Eliminar o accedió a elimina_producto.php desde listado_productos.php:-->
        <?php elseif (empty($_POST)):?> 
        <?php
        $datos = "SELECT 
        p.id AS id, 
        p.nombre AS nombre, 
        precio, 
        imagen, 
        c.nombre AS categoria 
        FROM productos p INNER JOIN categorías c ON p.categoría = c.id 
        WHERE p.id=".$_GET["id_eliminar"].";"
        ;
        $result = $conn->query($datos);
        $row = $result->fetch_assoc();
        ?>
        <h2>Eliminar producto</h2>
        <p>Nombre del producto: "<?php echo $row["nombre"]?>"</p>
        <p>Precio del producto: <?php echo $row["precio"]?></p>
        <p>Imagen del producto: <img src=<?php echo "imagenes/".$row["imagen"]?> width="100" height="100"></p>
        <p>Categoría del producto: "<?php echo $row["categoria"]?>"</p>
        <form action="elimina_producto.php" method="post">
            <input type="hidden" name="idBorrado" value="<?php echo $row["id"]?>">
            <input type="submit" value="Eliminar">
        </form>
        <?php endif;?>
        <?php
        //Desconexión, siempre se produce al final.
        mysqli_close($conn);
        ?>
    </body>