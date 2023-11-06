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
        $servername = "localhost";
        $username = "mitiendaonline";
        $password = "contraseña";
        $db = "mitiendaonline";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";

        $query = "SELECT * FROM productos";
        echo "<b> <center>Database Output</center> </b> <br> <br>";

        if ($result = $conn->query($query)) {
            echo "<div>";
            echo '<table border="1">';
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre</th>";
            echo "<th>Precio</th>";
            echo "<th>Imagen</th>";
            echo "<th>Categoría</th>";
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
                echo "<tr>";
                echo '<td>'.$id.'</td>';
                echo '<td>'.$Nombre.'</td>';
                echo '<td>'.$Precio.'</td>';
                echo '<td><img src="imagenes/'.$Imagen.'"width="80" height="80"/></td>';
                echo '<td>'.$categoria.'</td>';
                echo "</tr>";
                echo "<br>";
            }
            echo '</table>';
            echo "</div>";
        }

        /*freeresultset*/
        $result->free();
    ?>
    <title>Document</title>
</head>
<body>
    
</body>
</html>