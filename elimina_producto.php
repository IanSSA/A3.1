<!DOCTYPE HTML>  
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="edita_producto.css">
        <title>Editar producto</title>

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

            $id_cambiar = $_GET['id_editar'];
            if ($id_cambiar == ""){
                echo '<style type="text/css">
                        body {
                            text-align: center;
                        }
                        #div {
                            display: none;
                        }
                        </style>';
                $productos = "SELECT * FROM productos";
                if ($result = $conn->query($productos)) {
                    $server = $_SERVER['REQUEST_URI'];
                    echo "<div>";
                    echo "<h1>ID no encotrada, seleccione el producto a editar</h1>";
                    echo "<form action='$server' method='get'>";
                    echo "<select name='id_editar'>";
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $Nombre = $row["Nombre"];
                        echo '<option value='.$id.'>'.$Nombre.'</option>';
                        echo "<br>";
                    }
                    echo '</select><br>';
                    echo '<button type="submit" class="submit btn btn-primary mt-3">Enviar</button>';
                    echo '</form>';
                    echo "</div>";
                }
            } else {

                    $sql = "DELETE productos WHERE id='$id_cambiar'";

                    if (mysqli_query($conn, $sql)) {
                        echo "Se ha eliminado correctamente";
                        echo '<style type="text/css">
                        #div {
                            display: none;
                        }
                        </style>';
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                    mysqli_close($conn);
                }
        
    ?>
    </head>
    <body class="d-flex align-items-center">  
        <div name="div"  <?php if ($id_cambiar == ""){ echo 'style="display:none;"'; } ?>>
            <a href="listado_productos.php">Volver al listado</a>
        </div>
    </body>
</html>