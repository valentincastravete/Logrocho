<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha bar</title>
    <base href="<?= getHome(); ?>view/backend/">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body class="d-flex flex-column">
    <?php include "cabecera.php"; ?>
    <section class="container my-5">
        <div class="row mb-4">
            <div class="col-12 col-md-auto d-flex align-items-center justify-content-center justify-content-md-start">
                <button class="btn btn-lg btn-outline-primary btn-light me-2 flex-fill">Crear</button>
                <button class="btn btn-lg btn-outline-success btn-light me-2 flex-fill">Guardar</button>
                <button class="btn btn-lg btn-outline-danger btn-light flex-fill">Eliminar</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="form-floating">
                    <input type="text" name="nombre" id="nombre" value="Usuario x" class="form-control">
                    <label for="nombre">Nombre</label>
                </div>
            </div>
            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                <div class="form-floating">
                    <input type="text" name="correo" id="correo" value="correo@usuario.com" class="form-control">
                    <label for="correo">Correo electrónico</label>
                </div>
            </div>
        </div>
    </section>
    <?php include "footer.php"; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>