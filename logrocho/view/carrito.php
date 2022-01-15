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
    <title>Carrito</title>
</head>

<body style="margin: 0;">
    <?php include "cabecera.php"; ?>
    <div style="width: 40%; margin: 0 auto 5% auto;">
        <h1 style="text-align: center;">Carrito</h1>
        <div style="row-gap: 10px; display: flex; flex-direction: column; justify-content: flex-start;">
            <?php
            if ($productos->rowCount() === 0) {
                echo "<span style=\"font-size: 25px;\">No hay productos en el carrito.</span><a style=\"padding: 2%; text-align: center; background-color: black; text-decoration: none; color: white;\" href=\"" . getHome() . "categorias\">Ir a comprar</a>";
            } else {
                foreach ($categorias as $categoria) {
            ?>
                    <div style="font-size: 25px; padding: 2%; background-color: black; text-decoration: none; color: white;">
                        <?php echo $categoria["nombre"] . " " ?>
                    </div>
                    <?php
                    foreach ($productosArray as $producto) {
                        if ($categoria["cod_cat"] === $producto["cod_cat_fk"]) {
                    ?>
                            <div style="display: flex; justify-content: space-between; font-size: 25px; padding: 2%; margin-left: 3%; background-color: black; text-decoration: none; color: white; align-items: center;">
                                <div>
                                    <?php
                                    echo $producto["nombre"] . "<br>";
                                    echo "<div style=\"font-size: 20px\";>" . $producto['descripcion'] . "<br>";
                                    echo $producto['peso'] . " Kg<br>" . $producto['stock'] . " unidades disponibles" . "</div>";
                                    ?>
                                </div>
                                <form action="<?php echo getHome(); ?>eliminar" method="post" style="display: flex;">
                                    <input type="hidden" name="cod" id="cod" value="<?php echo sha1($producto['cod_prod']); ?>">
                                    <div style="display: flex; justify-content: flex-end; align-items: center; column-gap: 5%;">
                                        <label style="font-size: 20px;">Unidades: <?php echo $_SESSION['carrito'][sha1($producto["cod_prod"])]; ?></label>
                                        <input type="number" name="unidades" id="unidades" value="1" min="1" required style="width: 30%; height: 50%;">
                                        <input type="submit" value="-" style="background-color: transparent; color: white; border: none; padding: 0; padding-bottom: 3%; margin: 0; font-size: 50px; font-weight: 700; cursor: pointer;">
                                    </div>
                                </form>
                            </div>
            <?php
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
    <?php if ($productos->rowCount() > 0) { ?>
        <div style="display: flex; justify-content: center; text-align: center;">
            <a href="<?php echo getHome(); ?>procesar_pedido" style="text-decoration: none; border-radius: 15px; background-color: black; color: white; padding: 1%; margin: 0; font-size: 22px; font-weight: 700;">Realizar pedido</a>
        </div>
    <?php } ?>
    </div>
</body>

</html>