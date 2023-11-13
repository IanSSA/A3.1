<!DOCTYPE html>  
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="edita_producto.css">
        <title>Eliminar producto</title>
        <style>
          div {
            display: flex;
            flex-direction: column;
            align-items: center;
          }
          th, td {
            border: #21252a solid;
            padding-inline: 2%;
            text-align: center;
          }
          select {display: block;}
        </style>
    </head>
    <body>
        <?php 
        //Conexión, siempre se produce al inicio.
        $servername = "localhost";
        $username = "mitiendaonline";
        $password = "mitiendaonline";
        $db = "mitiendaonline";
        session_start();

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }        
        ?>
        <!--Si el usuario hizo click en Eliminar:-->
        <?php if(isset($_POST["idBorrado"])): ?> 
        <?php
        $borrado = "DELETE FROM productos WHERE id=".$_POST["idBorrado"];
        if (mysqli_query($conn,$borrado)){
            echo "<div>";
            echo "<h2>Producto eliminado correctamente</h2>";
            echo "<h3><a href='listado_productos.php'>Volver al listado</a></h3>";
            echo "</div>";
        } else{
            echo "Error: " . $borrado . "<br>" . mysqli_error($conn);
        }
        ?>
        <!--Si el usuario accedió a elimina_producto.php desde el índice:-->
        <?php elseif(empty($_GET)): ?>
        <div>
          <h1>ID no encontrada, seleccione el producto a eliminar:</h1>
          <form action="elimina_producto.php" method="get">
              <select name="id_eliminar">
                  <?php
                  $datos = "SELECT id, nombre FROM PRODUCTOS;";
                  if ($result = $conn->query($datos)){
                      while ($row = $result->fetch_assoc()){
                          $id = $row["id"];
                          $Nombre = $row["nombre"];
                          echo "<option value=$id>$Nombre</option>";
                      }
                  }
                  ?>
              </select>
              <button type="submit" class="submit btn btn-primary mt-3" onclick="crear_productos()">Enviar</button>
          </form>
        </div>
        <!--Si el usuario seleccionó el producto a Eliminar o accedió a elimina_producto.php desde listado_productos.php:-->
        <?php elseif (empty($_POST)):?> 
        <?php
        $datos = "SELECT 
        p.id AS id, 
        p.nombre AS nombre, 
        precio, 
        imagen, 
        c.nombre AS categoria 
        FROM productos p INNER JOIN categorías c ON p.categoría = c.id 
        WHERE p.id=".$_GET["id_eliminar"].";"
        ;
        $result = $conn->query($datos);
        $row = $result->fetch_assoc();
        ?>
        <div>
          <h2>Eliminar <?php echo $row["nombre"];?></h2>
          <table>
            <tr>
              <th>Nombre del producto</th>
              <th>Precio del producto</th>
              <th>Imagen del producto</th>
              <th>Categoría del producto</th>
            </tr>
            <tr>
               <td>"<?php echo $row["nombre"]?>"</td>
               <td><?php echo $row["precio"]?></td>
               <td><img src=<?php echo "imagenes/".$row["imagen"]?> width="100" height="100"></td>
               <td>"<?php echo $row["categoria"]?>"</td>
            </tr>
          </table>
          <form action="elimina_producto.php" method="post">
              <input type="hidden" name="idBorrado" value="<?php echo $row["id"]?>">
              <input type="submit" value="Eliminar">
          </form>
        </div>
        <?php endif;?>
        <?php
        //Desconexión, siempre se produce al final.
        mysqli_close($conn);
        ?>
    </body>