<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $servername = "localhost";
        $username = "mitiendaonline";
        $password = "contraseña";
        $db = "mitiendaonline";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        echo "Connected successfully";

        $query = "SELECT * FROM productos";
        echo "<b> <center>Database Output</center> </b> <br> <br>";

        if ($result = $conn->query($query)) {

            while ($row = $result->fetch_assoc()) {
                $field1name = $row["id"];
                $field2name = $row["Nombre"];
                $field3name = $row["Precio"];
                $field4name = $row["Imagen"];
                $field5name = $row["Categoría"];
                echo "<br>";
                echo '<b>'.$field1name.'</b><br />';
                echo $field2name.'<br />';
                echo $field3name.'<br />';
                echo $field4name.'<br />';
                echo $field5name. "<br>";
            }
        }

        /*freeresultset*/
        $result->free();
    ?>
    <title>Document</title>
</head>
<body>
    
</body>
</html>