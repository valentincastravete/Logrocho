<header class="bg-dark text-white text-center navbar navbar-expand-xl d-flex align-items-center justify-content-center justify-content-xl-start px-3 px-xl-5 text-center fs-4">
    <a href="<?= getIndex() . "bares" ?>" class="d-flex align-items-center mb-2 mb-xl-0 me-0 me-xl-5 text-dark text-decoration-none">
        <img src="" alt="Logo" class="px-3 py-2 btn btn-light btn-outline-dark">
    </a>

    <ul class="navbar-nav col-12 col-xl-auto me-xl-auto mb-2 justify-content-center mb-md-0">
        <li class="nav-item"><a href="<?= getIndex() . "bares" ?>" class="nav-link
        <?php if ($paginaBackendActual == $paginasBackend['bares']) {
            echo ' active fw-bold';
        } ?> px-3 py-2 mx-1">Bares</a></li>
        <li class="nav-item"><a href="<?= getIndex() . "pinchos" ?>" class="nav-link
        <?php if ($paginaBackendActual == $paginasBackend['pinchos']) {
            echo ' active fw-bold';
        } ?> px-3 py-2 mx-1">Pinchos</a></li>
        <li class="nav-item"><a href="<?= getIndex() . "contacto" ?>" class="nav-link
        <?php if ($paginaBackendActual == $paginasBackend['contacto']) {
            echo ' active fw-bold';
        } ?> px-3 py-2 mx-1">Contacto</a></li>
    </ul>

    <form class="col-12 col-xl-auto mb-3 mb-xl-0 me-xl-3">
        <input type="search" class="form-control" placeholder="Buscar..." aria-label="Buscar">
    </form>
    <div class="d-flex gap-2">
        <?php if (isAdminLoggedIn()) { ?>
            <a href="<?= getIndex() . "admin/bares"; ?>" class="btn btn-dark btn-outline-light text-decoration-none fs-5 float-end">Ir al panel de administración</a>
        <?php } ?>
        <?php if (isLoggedIn()) { ?>
            <a href="<?= getIndex() . "cerrar_sesion"; ?>" class="btn btn-dark btn-outline-light text-decoration-none fs-5 float-end">Cerrar sesion</a>
        <?php } else { ?>
            <a href="<?= getIndex() . "login"; ?>" class="btn btn-dark btn-outline-light text-decoration-none fs-5 float-end">Iniciar sesion</a>
        <?php } ?>
    </div>
</header>