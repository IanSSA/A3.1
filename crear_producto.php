<!DOCTYPE HTML>  
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <title>Crear productos</title>

        <?php
            $servername = "localhost";
            $username = "mitiendaonline";
            $password = "mitiendaonline";
            $db = "mitiendaonline";
    
            $conn = new mysqli($servername, $username, $password, $db);
    
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

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
                $ids = "SELECT id FROM productos";
                $ids_query = $conn->query($ids);

                if ($ids_query->num_rows > 0) {
                    while($row = $ids_query->fetch_assoc()) {
                        $id = $row["id"];
                    }
                    $id = $id +1;
                } else {
                    echo "0 results";
                }

                $sql = "INSERT INTO `productos`(`id`, `Nombre`, `Precio`, `Imagen`, `Categoría`) VALUES ($id, '$nombre', $precio, '$imagen', $categoria)";

                if (mysqli_query($conn, $sql)) {
                    echo "Se ha añadido correctamente";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                mysqli_close($conn);
            }
        
    ?>
    </head>
    <body class="d-flex align-items-center">  
        <div  class="d-flex justify-content-center container formulario mt-5">
            <form class="form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="pagina_actual" value="<?php echo $_SERVER['REQUEST_URI']; ?>">

                <p>Nombre:
                <input type="text" name="nombre" size="50" value="">
                </p>

                <p>Precio:
                <input type="number" name="precio" size="50" value="">
                </p> <br>

                <label for="myfile">Imagen producto:</label>
                <input type="file" id="myfile" name="imagen"> <br>
                
                <p>Categoría: <p>
                    <select name="categoria" id="categoria" multiple>
                        <option value="comida">Comida</option>
                        <option value="deporte">Deporte</option>
                        <option value="cocina" >Cocina</option>
                        <option value="herramientas">Herramientas</option>
                    </select>
            
                <button type="submit" class="submit btn btn-primary mt-3" onclick="crear_productos()">Enviar</button>
            </form>
        </div>

    </body>
</html>