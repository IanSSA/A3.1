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
                $datos_cambiar = "SELECT * FROM productos WHERE id=$id_cambiar";
                $datos_cambiar = $conn->query($datos_cambiar);
                $datos_cambiar = $datos_cambiar->fetch_assoc();
                $Nombre_cambiar = $datos_cambiar["Nombre"];
                $Precio_cambiar = $datos_cambiar["Precio"];
                $Imagen_cambiar = $datos_cambiar["Imagen"];
                $idcategoria = $datos_cambiar["Categoría"];

                if (isset($_POST["nombre"])){
                    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
                    $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : "";
                    $precio = isset($_POST["precio"]) ? $_POST["precio"] : "";
                    $precio = (int)$precio;
                    $imagen = $_FILES['imagen']['name'];
                    $id = 0;
                    if ($categoria == "comida"){
                        $categoria = 1;
                    } else if ($categoria == "deporte"){
                        $categoria = 2;
                    } else if ($categoria == "cocina"){
                        $categoria = 3;
                    } else if ($categoria == "herramientas"){
                        $categoria = 4;
                    }

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
            }
        
    ?>
    </head>
    <body class="d-flex align-items-center">  
        <div name="div"  <?php if ($id_cambiar == ""){ echo 'style="display:none;"'; } ?>>
            <form class="form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data" <?php if ($id_cambiar == ""){ echo 'style="display:none;"'; } ?>>
            <input type="hidden" name="pagina_actual" value="<?php echo $_SERVER['REQUEST_URI']; ?>">

                <p>Nombre:
                <input type="text" name="nombre" size="50" value="<?php echo $Nombre_cambiar; ?>">
                </p>

                <p>Precio:
                <input type="number" name="precio" size="50" value="<?php echo $Precio_cambiar; ?>">
                </p> <br>

                <label for="myfile">Imagen producto:</label>
                <input type="file" id="myfile" name="imagen"> <br>
                
                <p>Categoría: <p>
                    <select name="categoria" id="categoria" multiple>
                      <?php                 
                      global $idcategoria;
                      $categorias = "SELECT * FROM categorías";
                      if ($result = $conn->query($categorias)) {
                          while ($row = $result->fetch_assoc()) {
                              $id_row = $row["Id"];
                              $categoria_row = $row["Nombre"];
                              if ($id_row == $idcategoria){
                                echo '<option value="' . $categoria_row . '" selected="true">'. $categoria_row . '</option>';
                              } else {
                                echo '<option value="' . $categoria_row . '">'. $categoria_row . '</option>';
                              }
                          }
                        }
                      ?>
                    </select>
            
                <button type="submit" class="submit btn btn-primary mt-3" onclick="crear_productos()">Enviar</button>
            </form> <br>

            <a href="listado_productos.php">Volver al listado</a>
        </div>
    </body>
</html>