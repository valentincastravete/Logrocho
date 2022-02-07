<header class="bg-dark text-white text-center fs-1 d-flex align-items-center justify-content-around">
    <span class="text-center">MENÚ</span>
    <div class="d-flex gap-2">
        <?php if (isAdminLoggedIn()) { ?>
            <a href="<?= getIndex() . "bares"; ?>" class="btn btn-dark btn-outline-light text-decoration-none fs-5 float-end">Ir al panel de administración</a>
        <?php } ?>
        <?php if (isLoggedIn()) { ?>
            <a href="<?= getIndex() . "cerrar_sesion"; ?>" class="btn btn-dark btn-outline-light text-decoration-none fs-5 float-end">Cerrar sesion</a>
        <?php } else { ?>
            <a href="<?= getIndex() . "login"; ?>" class="btn btn-dark btn-outline-light text-decoration-none fs-5 float-end">Iniciar sesion</a>
        <?php } ?>
    </div>
</header>