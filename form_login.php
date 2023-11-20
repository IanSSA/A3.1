<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form_login.css">
    <title>Document</title>
    <?php
    session_start();
    
    if (isset($_POST["cerrar"])){
        $_SESSION = array();
        session_destroy();
    }
    ?>
</head>
<body>
    <div id="div">
        <form action="form.php" method="post">
            <label for="">Correo</label>
            <input type="text" name="correo"> <br>
            <label for="">Contraseña</label>
            <input type="text" name="contraseña"> <br>
            <input type="submit" name="" id="">
        </form>
        
    </div>
</body>
</html>