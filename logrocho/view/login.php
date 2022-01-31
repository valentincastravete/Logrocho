<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <base href="<?= getHome(); ?>">
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/main.css">
</head>

<body class="d-flex justify-content-center align-items-center text-center" style="height: 100vh;">
    <main class="form-signin border border-2 border-dark-50 rounded-3">
        <form method="POST" action="<?= getIndex() ?>login" class="m-5">
            <img src="img/logo.svg" alt="Logo">
            <h1 class="mt-5 mb-5">Inicio de sesión</h1>
            <?php
            if (isset($_GET["error"]) && $_GET["error"] == true) {
            ?>
                <p class="text-danger">Correo no existente o contraseña incorrecta.</p>
            <?php
            }
            ?>
            <p class="text-danger d-none">Correo no existente o contraseña incorrecta.</p>
            <div class="form-floating mb-3">
                <input type="email" class="campo form-control" id="email" name="email" placeholder="name@example.com" required>
                <label for="email">Correo</label>
                <div class="valid-feedback">
                    Campo introducido correctamente
                </div>
                <div class="invalid-feedback">
                    Campo obligatorio y/o formato de correo electrónico incorrecto
                </div>
            </div>
            <div class="form-floating">
                <input type="password" class="campo form-control" id="password" name="password" placeholder="Password" required <?php #pattern="^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$"
                                                                                                                                ?>>
                <label for="password">Contraseña</label>
                <div class="valid-feedback">
                    Campo introducido correctamente
                </div>
                <div class="invalid-feedback">
                    Campo obligatorio
                    <!-- y/o no cumple los requisitos mínimos de seguridad. (8 caractéres, 1 minúscula, 1 mayúscula y 1 número)-->
                </div>
            </div>
            <p class="small m-4"><a class="btn-outline-primary" href="<?= getHome() . "recuperar_cuenta"; ?>">He olvidado la contraseña</a></p>
            <input class="w-100 btn btn-outline-success btn-light" type="submit" value="Iniciar sesión">
            <p class="mt-5">¿No tienes cuenta? <a class="btn-outline-primary" href="<?= getHome() . "registro"; ?>" class="text-blue-50 fw-bold">Registrarse</a></p>
        </form>
    </main>
    <script src="view/js/validacion.js"></script>
    <script src="view/js/bootstrap.bundle.min.js"></script>
</body>

</html>