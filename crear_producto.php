<!DOCTYPE HTML>  
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <title>Formulario 2</title>

        <?php
        $pagina = isset($_POST["nombre"]) ? $_POST["pagina_actual"] : "";
        // Con el basename solo sacamos el nombre del fichero, no toda la URL
        $name_pagina = isset($_POST["pagina_actual"]) ? basename($_POST["pagina_actual"]) : "";
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
        $apellidos = isset($_POST["apellidos"]) ? $_POST["apellidos"] : "";
        $telefono = isset($_POST["phone"]) ? $_POST["phone"] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : "";
        $edad = isset($_POST['edad']) ? $_POST['edad'] : "";
        $pais = isset($_POST['pais']) ? $_POST['pais'] : "";
        $asignaturas_array = array_keys($_POST, "on");
        $asignaturas = arraystring($asignaturas_array);
        $errores = "";
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