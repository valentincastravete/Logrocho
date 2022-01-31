<?php
session_start();

require_once "controller/UsuarioController.php";
require_once "controller/BarController.php";
require_once "controller/PinchoController.php";
require_once "controller/ValoracionController.php";
require_once "utils.php";

$usuarioController = new UsuarioController;
$barController = new BarController;
$pinchoController = new PinchoController;
$valoracionController = new ValoracionController;
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
            if (isset($arguments[1])) {
                switch ($arguments[1]) {
                    case 'alta':
                        $barController->alta();
                        break;
                    case 'baja':
                        $barController->baja();
                        break;
                    case 'modificacion':
                        $barController->modificacion();
                        break;
                    default:
                        $usuarioController->index();
                }
            } else {
                $barController->getBar();
            }
            break;
        case 'pinchos':
            $pinchoController->getPinchos();
            break;
        case 'pincho':
            if (isset($arguments[1])) {
                switch ($arguments[1]) {
                    case 'alta':
                        $pinchoController->alta();
                        break;
                    case 'baja':
                        $pinchoController->baja();
                        break;
                    case 'modificacion':
                        $pinchoController->modificacion();
                        break;
                    default:
                        $usuarioController->index();
                }
            } else {
                $pinchoController->getPincho();
            }
            break;
        case 'valoraciones':
            $valoracionController->getValoraciones();
            break;
        case 'valoracion':
            if (isset($arguments[1])) {
                switch ($arguments[1]) {
                    case 'alta':
                        $valoracionController->alta();
                        break;
                    case 'baja':
                        $valoracionController->baja();
                        break;
                    case 'modificacion':
                        $valoracionController->modificacion();
                        break;
                    default:
                        $usuarioController->index();
                }
            } else {
                $valoracionController->getValoracion();
            }
            break;
        case 'usuarios':
            $usuarioController->getusuarios();
            break;
        case 'usuario':
            if (isset($arguments[1])) {
                switch ($arguments[1]) {
                    case 'alta':
                        $usuarioController->alta();
                        break;
                    case 'baja':
                        $usuarioController->baja();
                        break;
                    case 'modificacion':
                        $usuarioController->modificacion();
                        break;
                    default:
                        $usuarioController->index();
                }
            } else {
                $usuarioController->getUsuario();
            }
            break;
        default:
            $usuarioController->index();
    }
} else {
    $usuarioController->index();
}
