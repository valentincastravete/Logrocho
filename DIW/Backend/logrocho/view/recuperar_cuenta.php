<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar cuenta</title>
    <base href="<?= getHome(); ?>">
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/main.css">
</head>

<body class="d-flex justify-content-center align-items-center text-center" style="height: 100vh;">
    <main class="form-signin border border-2 border-dark-50 rounded-3">
        <form class="m-5">
            <h1 class="mt-5 mb-5">Recupera tu cuenta</h1>
            <p>Introduce tu dirección de correo electrónico y te enviaremos un enlace para cambiar tu contraseña.</p>
            <div class="form-floating mt-4">
                <input type="email" class="campo form-control" id="email" placeholder="name@example.com">
                <label for="email">Correo</label>
                <div class="valid-feedback">
                    Campo introducido correctamente
                </div>
                <div class="invalid-feedback">
                    Campo obligatorio y/o formato de correo electrónico incorrecto
                </div>
            </div>
            <button class="w-100 mt-4 btn btn-outline-success btn-light" type="submit">Enviar</button>
            <p class="mt-5">¿Ya te acuerdas de tu contraseña? <a class="btn-outline-primary" href="<?= getIndex(); ?>login" class="text-blue-50 fw-bold">Iniciar sesión</a></p>
        </form>
    </main>
    <script src="view/js/bootstrap.bundle.min.js"></script>
    <script src="view/js/validacion.js"></script>
</body>

</html>