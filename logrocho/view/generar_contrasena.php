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
    <title>Generar nueva contraseña</title>
</head>

<body>
    <div style="margin-top: 100px; margin-bottom: 100px; display:flex; align-items:center; justify-content:center; flex-direction:column; width:100%; row-gap: 10px;">
        <h1>Generar nueva contraseña</h1>
        <h2>Introduzca la nueva contraseña:</h2>
        <form method="POST" action="#" style="row-gap: 3%; display:flex; align-items:center; justify-content:space-around; flex-direction:column; height: 150px;">
            <label for="clave" style="font-size: 25px; font-weight: 700;">Contraseña</label>
            <input type="password" style="font-size: 14px;" name="clave" id="clave" required><br><br>
            <input type="submit" style="cursor: pointer; background-color: black; color: white; border: 0; font-size: 20px; font-weight: 700; padding: 4%;" value="Enviar">
        </form>
        <div>
            <hr>
            <a href="login.php" style="text-decoration: none; margin: 0; color: black; font-size: 15px; font-weight: 700;">Volver al login</a><br>
            <hr>
        </div>
    </div>
</body>

</html>