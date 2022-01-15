<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0">
    <title>Cambiar contraseña</title>
</head>

<body>
    <?php
    if (isset($_GET["error"])) {
    ?>
        <div style="text-align: center; color: white; background-color: green;">
            <?php
            if ($_GET["error"] == true) {
            ?>
                Correo no existente.
            <?php
            }
            ?>
        </div>
    <?php
    }
    ?>
    <?php
    if (isset($_GET["sent"])) {
    ?>
        <div style="text-align: center; color: white; background-color: green;">
            <?php
            if ($_GET["sent"] == true) {
            ?>
                Enlace para cambiar la contraseña enviado al correo indicado.
            <?php
            }
            ?>
        </div>
    <?php
    }
    ?>
    <div style="margin-top: 100px; margin-bottom: 100px; display:flex; align-items:center; justify-content:center; flex-direction:column; width:100%; row-gap: 10px;">
        <h1>Cambiar contraseña</h1>
        <h2>Introduzca su correo electrónico para enviarle el enlace para cambiar su contraseña:</h2>
        <form method="POST" action="<?php echo getHome(); ?>recordar_contrasena" style="row-gap: 3%; display:flex; align-items:center; justify-content:space-around; flex-direction:column; height: 150px;">
            <label for="user" style="font-size: 25px; font-weight: 700;">Correo</label>
            <input type="email" style="font-size: 14px;" name="user" id="user" required><br><br>
            <input type="submit" style="cursor: pointer; background-color: black; color: white; border: 0; font-size: 20px; font-weight: 700; padding: 4%;" value="Enviar">
        </form>
        <div>
            <hr>
            <a href="<?php echo getHome(); ?>login" style="text-decoration: none; margin: 0; color: black; font-size: 15px; font-weight: 700;">Volver al login</a><br>
            <hr>
        </div>
    </div>
</body>

</html>