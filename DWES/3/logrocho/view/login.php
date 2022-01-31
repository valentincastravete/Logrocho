<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <base href="<?php echo getHome(); ?>../">
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/main.css">
</head>

<body class="d-flex justify-content-center align-items-center text-center">
    <main class="form-signin border border-2 border-dark-50 rounded-3">
        <form method="POST" action="index.php/login" class="m-5">
            <img src="img/logo.svg" alt="Logo">
            <h1 class="mt-5 mb-5">Inicio de sesión</h1>
            <?php
            if (isset($_GET["error"]) && $_GET["error"] == true) {
            ?>
                <p class="text-danger">Correo no existente o contraseña incorrecta.</p>
            <?php
            }
            ?>
            <div class="form-floating">
                <input type="email" class="form-control" id="user" name="user" placeholder="name@example.com" required>
                <label for="user">Correo</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <label for="password">Contraseña</label>
            </div>
            <p class="small m-4"><a class="btn-outline-primary" href="recuperar_cuenta.html">He olvidado la contraseña</a></p>
            <input class="w-100 btn btn-outline-success btn-light" type="submit" value="Iniciar sesión">
            <p class="mt-5">¿No tienes cuenta? <a class="btn-outline-primary" href="registro_backend.html" class="text-blue-50 fw-bold">Registrarse</a></p>
        </form>
    </main>
</body>

</html>