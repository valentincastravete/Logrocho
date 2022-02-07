<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logrocho</title>
    <base href="<?= getHome(); ?>">
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/home.css">
</head>

<body>
    <?php include "cabecera.php"; ?>
    <main class="container">
        <section class="mt-5">
            <h1 class="text-center mb-4 fw-bolder">Logrocho</h1>
            <p class="fs-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur non deserunt ratione ut ipsum. Dolore architecto qui quibusdam? Consequuntur repellendus, corrupti possimus quo cumque sapiente et laudantium hic veniam at.</p>
        </section>
        <hr class="m-5">
        <section class="slider_home my-5">
            <h2 class="h1">Pinchos mejor valorados</h2>
            <div class="slider">
                <ul class="slides w-75">
                    <a class="slide mostrado" href="#"></a>
                    <a class="slide" href="#"></a>
                    <a class="slide" href="#"></a>
                    <a class="slide" href="#"></a>
                    <a class="slide" href="#"></a>
                </ul>
                <div class="m-2">
                    <button class="btn btn-light btn-outline-dark border-0 anterior fs-1">&lt;</button>
                    <button class="btn btn-light btn-outline-dark pausar">Pausar</button>
                    <button class="btn btn-light btn-outline-dark border-0 siguiente fs-1">&gt;</button>
                    <button class="btn btn-light btn-outline-dark cambio">Preferidos</button>
                </div>
            </div>
        </section>
        <hr class="m-5">
        <section class="mejores_pinchos mb-5">
            <h2 class="h1">Pinchos destacados</h2>
            <div class="row">
                <article class="col-12 col-md-6 col-lg-4 p-4">
                    <a class="card text-decoration-none text-dark h-100" href="#">
                        <img src="view/img/pincho6.jpg" class="card-img-top" alt="Pincho lorem">
                        <div class="card-header">
                            Bar Lorem, ipsum. Calle Lorem, ipsum dolor.
                        </div>
                        <div class="card-body ">
                            <h5 class="card-title">Pincho lorem</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, autem!</p>
                        </div>
                    </a>
                </article>
                <article class="col-12 col-md-6 col-lg-4 p-4 text-center">
                    <a class="card text-decoration-none text-dark h-100" href="#">
                        <div class="card-header">
                            Bar Lorem, ipsum. Calle Lorem, ipsum dolor.
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Pincho lorem, ipsum dolor</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur quod facilis voluptatum nostrum aut culpa dolor est soluta possimus sed!</p>
                        </div>
                        <img src="view/img/pincho2.jpg" class="card-img-bottom" alt="Pincho lorem, ipsum dolor">
                    </a>
                </article>
                <article class="col-12 col-md-6 col-lg-4 offset-md-3 offset-lg-0 p-4 text-end">
                    <a class="card text-decoration-none text-dark h-100" href="#">
                        <img src="view/img/pincho7.jpg" class="card-img-top" alt="Pincho lorem, ipsum">
                        <div class="card-header">
                            Bar Lorem, ipsum. Calle Lorem, ipsum dolor.
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Pincho especial de pulpo</h5>
                            <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
                        </div>
                    </a>
                </article>
            </div>
        </section>
    </main>
    <?php include "footer.php"; ?>
    <script src="view/js/slider.js"></script>
    <script src="view/js/bootstrap.bundle.min.js"></script>
</body>

</html>