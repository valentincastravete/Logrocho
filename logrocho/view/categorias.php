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
    <title>Categorías de producto</title>
    <base href="<?php echo getAbsolutePath(); ?>">
</head>

<body style="margin: 0;">
    <?php include "cabecera.php"; ?>
    <div style="width: 40%; margin: 0 auto 5% auto;">
        <h1 style="text-align: center;">Categorías</h1>
        <div style="row-gap: 10px; display: flex; flex-direction: column; justify-content: flex-start;">
            <?php
            if (count($categorias) === 0) {
                echo "<span style=\"font-size: 25px;\">No hay categorías</span>";
            } else {
                foreach ($categorias as $categoria) {
            ?>
                    <a style="font-size: 25px; padding: 2%; background-color: black; text-decoration: none; color: white;" href="categoria/<?php echo sha1($categoria["CodCat"]) ?>">
                        <?php echo $categoria["nombre"] ?>
                    </a>
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>

</html>