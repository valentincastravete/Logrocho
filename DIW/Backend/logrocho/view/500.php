<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500</title>
    <base href="<?= getHome(); ?>">
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/main.css">
</head>

<body class="d-flex flex-column">
    <header class="bg-success text-white navbar navbar-expand-xl navbar-dark d-flex align-items-center justify-content-center justify-content-xl-start px-3 px-xl-5 text-center mb-auto fs-4 h-auto">
        <a href="#" class="d-flex align-items-center mb-2 mb-xl-0 me-0 me-xl-5 text-dark text-decoration-none">
            <img src="img/logo.svg" alt="Logo" class="text-white">
        </a>

        <ul class="navbar-nav col-12 col-xl-auto me-xl-auto mb-2 justify-content-center mb-xl-0">
            <li class="nav-item"><a href="#" class="nav-link px-3 py-2 mx-1">Bares</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-3 py-2 mx-1">Pinchos</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-3 py-2 mx-1">Valoraciones</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-3 py-2 ms-1">Usuarios</a></li>
        </ul>

        <form class="col-12 col-xl-auto mb-3 mb-xl-0 me-xl-3">
            <input type="search" class="form-control" placeholder="Buscar..." aria-label="Buscar">
        </form>

        <div class="dropdown text-end">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">correo@usuario.com</a>
            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="login.html">Cerrar sesión</a></li>
            </ul>
        </div>
    </header>

    <section class="container my-5 my-xl-auto">
        <div class="row d-flex justify-content-center align-items-center align-content-center">
            <div class="col-12 text-center fs-1">
                Disculpe las molestias
            </div>
            <div class="col-12 text-center fs-5">
                Nuestros servicios están teniendo problemas internos, se resolverán lo antes posible.
            </div>
            <div class="col-12 text-center fs-5 mt-5">
                <a href="<?= getIndex() ?>" class="btn btn-outline-dark btn-light text-decoration-none fs-5">Ir a la página de inicio</a>
            </div>
        </div>
    </section>

    <footer class="bg-success text-white d-flex flex-wrap justify-content-center align-items-center p-3 border-top border-2 mt-auto">
        <span>© 2021 Logrocho, Valentín Georgian Castravete</span>
    </footer>


    <script src="view/js/bootstrap.bundle.min.js"></script>
</body>

</html>