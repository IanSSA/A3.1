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
                if (isset($_COOKIE['errores_login'])){
                    $num_errores = htmlspecialchars($_COOKIE['errores_login']);
                    setcookie('errores_login', 0 , time()+3,154e+7, '/');
                }
                $color = $password_hash["color_fondo"];
                if ($color == ""){
                    if (isset($_COOKIE['color_fondo'])){
                        setcookie('color_fondo', '#808080', time()+86400, '/');
                    } else {
                        setcookie('color_fondo', '#808080', time()+86400);
                    }
                } else {
                    if (isset($_COOKIE['color_fondo'])){
                        setcookie('color_fondo', $color, time()+86400, '/');
                    } else {
                        setcookie('color_fondo', $color, time()+86400);
                    }
                }     
                $_SESSION["usuario"] = $password_hash["nombre"];
                header('Location: index.php');
            } else{
                if (isset($_COOKIE['errores_login'])){
                    $num_errores = htmlspecialchars($_COOKIE['errores_login']);
                    setcookie('errores_login',$num_errores +1, time()+3,154e+7, '/');
                } else {
                    setcookie('errores_login', 1, time()+3,154e+7);
                }
                echo "La contraseña no coincide";
                $num_errores = $_COOKIE['errores_login'];
                echo "LLevas " . $num_errores . " errores de inicio de sesión";
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