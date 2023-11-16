<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        $servername = "localhost";
        $username = "mitiendaonline";
        $password = "mitiendaonline";
        $db = "mitiendaonline";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        echo password_hash("rasmuslerdorf", PASSWORD_DEFAULT)."\n";

        $contra = isset($_POST["contraseña"]) ? $_POST["contraseña"] : "";
        $correo = isset($_POST["correo"]) ? $_POST["correo"] : "";

        $contrasena_hash = "SELECT contrasena_hash FROM usuarios2 where correo_electronico='$correo'";
        $password_hash = $conn->query($contrasena_hash);
        $password_hash = $password_hash->fetch_assoc();
        if (password_verify($contra, $password_hash["contrasena_hash"])){
            echo "La contraseña coincide";
        } else{
            echo "La contraseña no coincide";
        }

    ?>
</head>
<body>
    
</body>
</html>