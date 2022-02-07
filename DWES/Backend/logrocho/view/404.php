<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>
    <base href="<?= getHome(); ?>">
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/main.css">
</head>

<body class="d-flex flex-column">
    <?php include "view/cabecera.php"; ?>

    <section class="container my-5 my-xl-auto">
        <div class="row d-flex justify-content-center align-items-center align-content-center">
            <div class="col-12 text-center fs-1">
                Lo sentimos
            </div>
            <div class="col-12 text-center fs-5">
                No hemos encontrado la página que buscabas.
            </div>
            <div class="col-12 text-center fs-5 mt-5">
                <a href="index.php" class="btn btn-outline-dark btn-light text-decoration-none fs-5">Ir a la página de inicio</a>
            </div>
        </div>
    </section>
    <?php include "view/footer.php"; ?>

    <script src="view/js/bootstrap.bundle.min.js"></script>
</body>

</html>