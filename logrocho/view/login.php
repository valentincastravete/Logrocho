<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php
    if (isset($_GET["error"]) || isset($_GET["logged_in"])) {
    ?>
        <div style="text-align: center; color: white; background-color: green;">
            <?php
            if (isset($_GET["error"]) && $_GET["error"] == true) {
            ?>
                Error de autenticación. Correo y/o contraseña inválidos.
            <?php
            } else if (isset($_GET["logged_in"]) && $_GET["logged_in"] == 0) {
            ?>
                Debe iniciar sesión para acceder a la página.
            <?php
            }
            ?>
        </div>
    <?php
    }
    ?>
    <div style="margin-top: 100px; margin-bottom: 100px; display:flex; align-items:center; justify-content:center; flex-direction:column; width:100%; row-gap: 50px;">
        <h1>Inicio de sesión</h1>
        <form method="POST" action="<?php echo getHome() . "login"; ?>" style="row-gap: 3%; display:flex; align-items:center; justify-content:space-around; flex-direction:column; height:150px;">
            <label for="user" style="font-size: 25px; font-weight: 700;">Correo</label>
            <input type="email" style="font-size: 14px;" name="user" id="user" required><br><br>
            <label for="password" style="font-size: 25px; font-weight: 700;">Clave</label>
            <input type="password" style="font-size: 14px;" name="password" id="password" required><br><br>
            <input type="submit" style="cursor: pointer; background-color: black; color: white; border: 0; font-size: 20px; font-weight: 700; padding: 4%;" value="Iniciar sesión">
        </form>
        <div>
            <hr>
            ¿Todavía no tienes cuenta? <a href="<?php echo getHome() . "registro"; ?>" style="text-decoration: none; margin: 0; color: black; font-size: 15px; font-weight: 700;">Registrarse</a><br>
            <hr>
            ¿Has olvidado la contraseña? <a href="<?php echo getHome() . "recordar_contrasena"; ?>" style="text-decoration: none; margin: 0; color: black; font-size: 15px; font-weight: 700;">Recordar contraseña</a>
            <hr>
        </div>
    </div>
</body>

</html>