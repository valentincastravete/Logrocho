<?php
if (session_status() === PHP_SESSION_NONE) {
    require "view/404.php";
    die;
}
?>

<header style="display: flex; background-color: black; padding: 1%;">
    <div style="display: flex; column-gap: 2%; justify-content: flex-start; align-items: center; flex-grow: 1; font-size: 20px; color: white;">
        <b>Usuario:</b><?php echo $_SESSION['user'][1] ?>
        <a style="padding: 5px; font-weight: 500; font-size: 20px; border: 1px solid white; text-decoration: none; color: white;" href="<?php echo getHome(); ?>logout">Cerrar sesión</a>
    </div>
    <nav style="display: flex; column-gap: 2%; justify-content: flex-end; flex-grow: 1;">
        <a style="padding: 5px; font-weight: 500; font-size: 20px; border: 1px solid white; text-decoration: none; color: white;" href="<?php echo getHome(); ?>carrito">Carrito</a>
        <a style="padding: 5px; font-weight: 500; font-size: 20px; border: 1px solid white; text-decoration: none; color: white;" href="<?php echo getHome(); ?>categorias">Categorías</a>
    </nav>
</header>