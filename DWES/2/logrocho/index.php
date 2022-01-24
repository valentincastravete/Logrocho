<?php
session_start();

require_once "controller/UsuarioController.php";
require_once "controller/BarController.php";
require_once "controller/PinchoController.php";
require_once "utils.php";

$usuarioController = new UsuarioController;
$barController = new BarController;
$pinchoController = new PinchoController;
$arguments = getArguments();
$hasArguments = (count($arguments) > 0);
/**
 * Redirige al controlador correspondiente dependiendo de la URL
 */
if ($hasArguments && isset($arguments[0])) {
    switch ($arguments[0]) {
        case 'login':
            $usuarioController->index();
            break;
        case 'logged':
            require "view/logged.php";
            break;
        case 'bares':
            $barController->getBares();
            break;
        case 'bar':
            $barController->getBar();
            break;
        case 'pinchos':
            $pinchoController->getPinchos();
            break;
        case 'pincho':
            $pinchoController->getPincho();
            break;
        default:
            $usuarioController->index();
    }
} else {
    $usuarioController->index();
}
