<?php
session_start();

require_once "controller/UsuarioController.php";
require_once "utils.php";

$usuarioController = new UsuarioController;
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
        default:
            $usuarioController->index();
    }
} else {
    $usuarioController->index();
}
