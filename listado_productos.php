<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {margin: 0 auto;
            text-align: center; 
            border-color: black;
        }
    </style>
    <?php
        session_start();

        if(isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
            echo 'Sesión iniciada correctamente';
         } else {
            echo 'sesión no iniciada';
            header('Location: form_login.php');
         }

        $servername = "localhost";
        $username = "mitiendaonline";
        $password = "mitiendaonline";
        $db = "mitiendaonline";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT * FROM productos";
        echo "<h2> <center>Listado de productos</center> </h2>";

        if ($result = $conn->query($query)) {
            echo "<div>";
            echo '<table border="1">';
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre</th>";
            echo "<th>Precio</th>";
            echo "<th>Imagen</th>";
            echo "<th>Categoría</th>";
            echo "<th>Editar</th>";
            echo "<th>Eliminar</th>";
            echo "</tr>";
            while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $Nombre = $row["Nombre"];
                $Precio = $row["Precio"];
                $Imagen = $row["Imagen"];
                $idcategoria = $row["Categoría"];
                $categoria = "SELECT Nombre FROM categorías WHERE Id=$idcategoria";
                $categoria = $conn->query($categoria);
                $categoria = $categoria->fetch_assoc();
                $categoria = $categoria["Nombre"];
                echo "<br>";
                echo "<form action='edita_producto.php'>";
                echo "<tr>";
                echo '<td>'.$id.'</td>';
                echo "<input type='hidden' name='id' value='". $id . "'>";
                echo '<td>'.$Nombre.'</td>';
                echo '<td>'.$Precio.'</td>';
                echo '<td><img src="imagenes/'.$Imagen.'"width="80" height="80"/></td>';
                echo '<td>'.$categoria.'</td>';
                echo '<td><a href="edita_producto.php?id_editar='. $id . '">Editar</a> </td>';
                echo '<td><a href="elimina_producto.php?id_eliminar='. $id . '">Elimina</a> </td>';
                echo "</tr>";
                echo "</form>";
                echo "<br>";
            }
            echo '</table>';
            echo '<div id="enlace">';
            echo '<a href="crear_producto.php">Crear nuevo producto</a>';
            echo'</div>';
            echo "</div>";
        }

        $result->free();

        if (isset($_POST["cerrar"])){
            $_SESSION = array();
            session_destroy();
        }
    ?>
     <link rel="stylesheet" href="listado_producto.css">
    <title>Listado productos</title>
</head>
<body>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    <label for="">Cerrar sesión</label>
        <input type="submit" name="cerrar">
    </form>
</body>
</html>