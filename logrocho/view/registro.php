<?php
if (session_status() === PHP_SESSION_NONE) {
    require "404.php";
    die;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0">
    <title>Página de registro</title>
</head>

<body>
    <?php
    if (isset($_GET["error"])) {
    ?>
        <div style="text-align: center; color: white; background-color: green;">
            <?php
            if (isset($_GET["error"]) && $_GET["error"] == true) {
            ?>
                Error de registro. Correo ya existente.
            <?php
            }
            ?>
        </div>
    <?php
    }
    ?>
    <div style="margin-top: 100px; margin-bottom: 100px; display:flex; align-items:center; justify-content:center; flex-direction:column; width:100%; row-gap: 70px;">
        <h1>Página de registro</h1>
        <form method="POST" action="<?php echo getHome(); ?>registro" style="row-gap: 3%; display:flex; align-items:center; justify-content:space-around; flex-direction:column; height:300px;">
            <label for="user" style="font-size: 25px; font-weight: 700;">Correo</label>
            <input type="email" style="font-size: 14px;" name="user" id="user" required><br><br>
            <label for="password" style="font-size: 25px; font-weight: 700;">Clave</label>
            <input type="password" style="font-size: 14px;" name="password" id="password" required><br><br>
            <label for="address" style="font-size: 25px; font-weight: 700;">Dirección</label>
            <input type="address" style="font-size: 14px;" name="address" id="address" ><br><br>
            <label for="cp" style="font-size: 25px; font-weight: 700;">CP</label>
            <input type="cp" style="font-size: 14px;" name="cp" id="cp" ><br><br>
            <label for="country" style="font-size: 25px; font-weight: 700;">País</label>
            <input type="country" style="font-size: 14px;" name="country" id="country" ><br><br>
            <input type="submit" style="cursor: pointer; background-color: black; color: white; border: 0; font-size: 20px; font-weight: 700; padding: 4%;" value="Registrarse">
        </form>
        <div>
            <hr>
            <a href="<?php echo getHome(); ?>" style="text-decoration: none; margin: 0; color: black; font-size: 15px; font-weight: 700;">Volver al login</a><br>
            <hr>
        </div>
    </div>
</body>

</html>