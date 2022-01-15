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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Pedido</title>
</head>

<body>
    <div style="
    display: flex;
    flex-direction: column;
    row-gap: 20px;
    justify-content: center;
    top: 50%;
    transform: translateY(-50%) translateX(-50%);
    position: absolute;
    align-items: center;
    text-align: center;
    padding: 3%;
    left: 50%;
    font-size: 25px;">
        <?php echo $mensaje; ?>
        <a href="<?php echo getHome(); ?>" style="text-decoration: none; border-radius: 10px; background-color: black; color: white; padding: 2%; margin: 0; font-size: 22px; font-weight: 700;">Home</a>
    </div>
</body>

</html>