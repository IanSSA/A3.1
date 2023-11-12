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
        <?php if(empty($_GET)): ?>
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
        <?php else:?>

        <?php endif;?>
        <?php
        mysqli_close($conn);
        ?>
    </body>