<header class="bg-success text-white navbar navbar-expand-xl navbar-dark d-flex align-items-center justify-content-center justify-content-xl-start px-3 px-xl-5 text-center fs-4">
    <a href="<?= getIndex() . "admin/bares" ?>" class="d-flex align-items-center mb-2 mb-xl-0 me-0 me-xl-5 text-dark text-decoration-none">
        <img src="" alt="Logo" class="px-3 py-2 btn btn-light btn-outline-dark">
    </a>

    <ul class="navbar-nav col-12 col-xl-auto me-xl-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item"><a href="<?= getIndex() . "admin/bares" ?>" class="nav-link
        <?php if ($paginaBackendActual == $paginasBackend['bares']) {
            echo ' active fw-bold';
        } ?> px-3 py-2 mx-1">Bares</a></li>
        <li class="nav-item"><a href="<?= getIndex() . "admin/pinchos" ?>" class="nav-link
        <?php if ($paginaBackendActual == $paginasBackend['pinchos']) {
            echo ' active fw-bold';
        } ?> px-3 py-2 mx-1">Pinchos</a></li>
        <li class="nav-item"><a href="<?= getIndex() . "admin/valoraciones" ?>" class="nav-link
        <?php if ($paginaBackendActual == $paginasBackend['valoraciones']) {
            echo ' active fw-bold';
        } ?> px-3 py-2 mx-1">Valoraciones</a></li>
        <li class="nav-item"><a href="<?= getIndex() . "admin/usuarios" ?>" class="nav-link
        <?php if ($paginaBackendActual == $paginasBackend['usuarios']) {
            echo ' active fw-bold';
        } ?> px-3 py-2 ms-1">Usuarios</a></li>
    </ul>

    <form class="col-12 col-xl-auto mb-3 mb-xl-0 me-xl-3">
        <input type="search" class="form-control" placeholder="Buscar..." aria-label="Buscar">
    </form>

    <div class="dropdown text-end">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle fs-5" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['user'][1] ?></a>
        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser">
            <li><a class="dropdown-item" href="<?= getIndex() . "cerrar_sesion" ?>">Cerrar sesión</a></li>
            <li><a class="dropdown-item" href="<?= getIndex() ?>">Ir a página frontal</a></li>
        </ul>
    </div>
</header>