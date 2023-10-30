<!DOCTYPE HTML>  
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <title>Crear productos</title>

        <?php

        function crear_productos(){
            $servername = "localhost";
            $username = "mitiendaonline";
            $password = "contraseña";
            $db = "mitiendaonline";
    
            $conn = new mysqli($servername, $username, $password, $db);
    
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            echo "Connected successfully";
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : "";
        $precio = isset($_POST["precio"]) ? $_POST["precio"] : "";
        $imagen = $_FILES['imagen']['name'];
        $id = 0;

        $sql = "SELECT id FROM productos";

        $datos = mysqli_query($conn, $sql);
        $arrayDatos = array();

        while($row = mysqli_fetch_array($datos)){
            $arrayDatos[] = $row;
        }
        print_r ($arrayDatos);

        $sql = "INSERT INTO productos (id, nombre, precio, categria, imagen) VALUES ($id, $nombre, $precio, $categoria, $imagen)";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
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
            
                <button type="submit" class="submit btn btn-primary mt-3">Enviar</button>
            </form>
        </div>

    </body>
</html>