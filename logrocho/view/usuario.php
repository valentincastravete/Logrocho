<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha bar</title>
    <base href="<?php echo getHome(); ?>../">
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/home.css">
</head>

<body class="d-flex flex-column">
<header class="bg-success text-white navbar navbar-expand-xl navbar-dark d-flex align-items-center justify-content-center justify-content-xl-start px-3 px-xl-5 text-center fs-4">
        <a href="<?php echo "index.php/bares"; ?>" class="d-flex align-items-center mb-2 mb-xl-0 me-0 me-xl-5 text-dark text-decoration-none">
            <img src="img/logo.svg" alt="Logo" class="text-white">
        </a>

        <ul class="navbar-nav col-12 col-xl-auto me-xl-auto mb-2 justify-content-center mb-md-0">
            <li class="nav-item"><a href="<?php echo "index.php/bares"; ?>" class="nav-link px-3 py-2 mx-1">Bares</a></li>
            <li class="nav-item"><a href="<?php echo "index.php/pinchos"; ?>" class="nav-link px-3 py-2 mx-1">Pinchos</a></li>
            <li class="nav-item"><a href="<?php echo "index.php/valoraciones"; ?>" class="nav-link px-3 py-2 mx-1">Valoraciones</a></li>
            <li class="nav-item"><a href="<?php echo "index.php/usuarios"; ?>" class="nav-link active px-3 py-2 ms-1">Usuarios</a></li>
        </ul>

        <form class="col-12 col-xl-auto mb-3 mb-xl-0 me-xl-3">
            <input type="search" class="form-control" placeholder="Buscar..." aria-label="Buscar">
        </form>

        <div class="dropdown text-end">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">correo@usuario.com</a>
            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="<?php echo "index.php/cerrar_sesion"; ?>">Cerrar sesión</a></li>
            </ul>
        </div>
    </header>

    <section class="container my-5">
        <div class="row mb-4">
            <div class="col-12 col-md-auto d-flex align-items-center justify-content-center justify-content-md-start">
                <button class="btn-lg btn-outline-primary btn-light me-2 flex-fill">Crear</button>
                <button class="btn-lg btn-outline-primary btn-light me-2 flex-fill">Guardar</button>
                <button class="btn-lg btn-outline-primary btn-light flex-fill">Eliminar</button>
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

    <footer class="bg-success text-white d-flex flex-wrap justify-content-center align-items-center p-3 border-top border-2 mt-auto">
        <span>© 2021 Logrocho, Valentín Georgian Castravete</span>
    </footer>


    <script src="view/js/bootstrap.bundle.min.js"></script>
</body>

</html>