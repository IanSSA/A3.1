<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
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

    $id = $_GET["id"];

    $producto = "SELECT * FROM productos W"
    ?>
</head>
<body>
    
</body>
</html>