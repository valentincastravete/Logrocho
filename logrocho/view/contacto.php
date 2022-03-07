<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de bares</title>
    <base href="<?= getHome(); ?>view/">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="d-flex flex-column">
    <?php include "cabecera.php"; ?>
    <section class="container my-5">
        <form>
            <div class="mb-5">
                <h1>Contacto</h1>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="campo form-control" id="email" name="email" placeholder="name@example.com" required>
                <label for="email">Correo*</label>
                <div class="valid-feedback">
                    Campo introducido correctamente
                </div>
                <div class="invalid-feedback">
                    Campo obligatorio y/o formato de correo electrónico incorrecto
                </div>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="campo form-control" id="asunto" name="asunto" placeholder="No se ve el bar de X bien" required>
                <label for="asunto">Asunto*</label>
                <div class="valid-feedback">
                    Campo introducido correctamente
                </div>
                <div class="invalid-feedback">
                    Campo obligatorio
                </div>
            </div>
            <div class="form-floating mb-3">
                <textarea class="campo form-control" style="height: 300px;" id="mensaje" name="mensaje" placeholder="name@example.com" rows="10" required></textarea>
                <label for="mensaje">Mensaje*</label>
                <div class="valid-feedback">
                    Campo introducido correctamente
                </div>
                <div class="invalid-feedback">
                    Campo obligatorio
                </div>
            </div>
            <input class="w-100 btn btn-outline-primary btn-light" type="submit" value="Enviar">
        </form>
    </section>
    <?php include "footer.php"; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/validacion.js"></script>
</body>

</html>