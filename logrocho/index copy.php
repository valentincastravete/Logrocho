<?php
session_start();

require_once "controller/CategoriaController.php";
require_once "controller/RestauranteController.php";
require_once "controller/CarritoController.php";
require_once "utils.php";

$categoriaController = new CategoriaController;
$restauranteController = new RestauranteController;
$carritoController = new CarritoController;
$arguments = getArguments();
$hasArguments = (count($arguments) > 0);
$errorInicioSesion;
/**
 * Redirige al controlador correspondiente dependiendo de la URL
 */
if ($hasArguments && isset($arguments[0])) {
    switch ($arguments[0]) {
        case 'login':
            $restauranteController->index();
            break;
        case 'logout':
            $restauranteController->logout();
            break;
        case 'registro':
            $restauranteController->registro();
            break;
        case 'recordar_contrasena':
            $restauranteController->recordar_contrasena();
            break;
        case 'generar_contrasena':
            $restauranteController->generar_contrasena();
            break;
        case 'categorias':
            $categoriaController->index();
            break;
        case 'categoria':
            if (isset($arguments[1])) {
                $categoriaController->showCategoria($arguments[1]);
            }
            break;
        case 'carrito':
            $carritoController->index();
            break;
        case 'anadir':
            $carritoController->anadirProducto();
            break;
        case 'eliminar':
            $carritoController->eliminarProducto();
            break;
        case 'procesar_pedido':
            $carritoController->procesar_pedido();
            break;
        default:
            require "view/404.php";
    }
} else {
    $restauranteController->index();
}
