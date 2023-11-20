<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Document</title>
    <?php
        session_start();
        $servername = "localhost";
        $username = "mitiendaonline";
        $password = "mitiendaonline";
        $db = "mitiendaonline";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $contra = isset($_POST["contraseña"]) ? $_POST["contraseña"] : "";
        $correo = isset($_POST["correo"]) ? $_POST["correo"] : "";

        $contrasena_hash = "SELECT * FROM usuarios2 where correo_electronico='$correo'";
        $password_hash = $conn->query($contrasena_hash);
        $password_hash = $password_hash->fetch_assoc();
        if ($password_hash){
            if (password_verify($contra, $password_hash["contrasena_hash"])){
                echo "La contraseña coincide";
                $_SESSION["usuario"] = $password_hash["nombre"];
                header('Location: index.html');
            } else{
                echo "La contraseña no coincide";
            }
        } else{
            echo "El correo no se encuentra en la base de datos";
        }
        
    ?>
</head>
<body>
<h2><a href="form_login.php" style="color: black;
    text-decoration: none;">Volver a iniciar sesión</a></h2>
</body>
</html>