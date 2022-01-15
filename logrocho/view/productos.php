<?php
if (session_status() === PHP_SESSION_NONE) {
    require "view/404.php";
    die;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0">
    <title>Productos</title>
</head>

<body style="margin: 0;">
    <?php include "cabecera.php"; ?>
    <div style="width: 40%; margin: 0 auto 5% auto;">
        <h1 style="text-align: center;">Productos</h1>
        <div style="row-gap: 10px; display: flex; flex-direction: column; justify-content: flex-start;">
            <?php
            if ($productos->rowCount() === 0) {
                echo "<span style=\"font-size: 25px;\">No hay productos o no existe la categoría solicitada.</span>";
            } else {
            ?>
                <div style="font-size: 25px; padding: 2%; background-color: black; text-decoration: none; color: white;">
                    <?php echo $categoria["nombre"] . " " ?>
                </div>
                <?php
                foreach ($productos as $producto) {
                ?>
                    <div style="display: flex; justify-content: space-between; font-size: 25px; padding: 2%; margin-left: 3%; background-color: black; text-decoration: none; color: white; align-items: center;">
                        <div>
                            <?php
                            echo $producto["nombre"] . "<br>";
                            echo "<div style=\"font-size: 20px\";>" . $producto['descripcion'] . "<br>";
                            echo $producto['peso'] . " Kg<br>" . $producto['stock'] . " unidades disponibles" . "</div>";
                            ?>
                        </div>
                        <form action="<?php echo getHome(); ?>anadir" method="POST" style="display: flex;">
                            <input type="hidden" name="cod" id="cod" value="<?php echo sha1($producto['cod_prod']); ?>">
                            <div style="display: flex; justify-content: flex-end; align-items: center; column-gap: 5%;">
                                <input type="number" name="unidades" id="unidades" value="1" min="1" required style="width: 30%; height: 50%;">
                                <input type="submit" value="+" style="background-color: transparent; color: white; border: none; padding: 0; padding-bottom: 3%; margin: 0; font-size: 50px; font-weight: 700; cursor: pointer;">
                            </div>
                        </form>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>

</html>