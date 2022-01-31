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
    if (!isLoggedIn() && !in_array($arguments[0], ["login", "recuperar_cuenta", "home"])) {
        require("view/404.php");
    } else {
        if (
            isLoggedIn() && !isAdminLoggedIn() &&
            (in_array($arguments[0], ["bares", "pinchos", "valoraciones", "usuarios", "bd"]) ||
                (isset($arguments[1]) && in_array($arguments[1], ["usuarios", "usuario"])))
        ) {
            require("view/404.php");
        } else {
            if ($arguments[0])
                switch ($arguments[0]) {
                    case 'login':
                        $usuarioController->login();
                        break;
                    case 'recuperar_cuenta':
                        require("view/recuperar_cuenta.php");
                        break;
                    case 'cerrar_sesion':
                        $usuarioController->cerrarSesion();
                        break;
                    case 'home':
                        require("view/home.php");
                        break;
                    case 'bares':
                        require("view/bares.php");
                        break;
                    case 'pinchos':
                        require("view/pinchos.php");
                        break;
                    case 'valoraciones':
                        require("view/valoraciones.php");
                        break;
                    case 'usuarios':
                        require("view/usuarios.php");
                        break;
                    case 'bar':
                        require("view/bar.php");
                        break;
                    case 'pincho':
                        require("view/pincho.php");
                        break;
                    case 'valoracion':
                        require("view/valoracion.php");
                        break;
                    case 'usuario':
                        require("view/usuario.php");
                        break;
                    case 'api':
                        if (isset($arguments[1])) {
                            switch ($arguments[1]) {
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
                                case 'valoraciones':
                                    $valoracionController->getValoraciones();
                                    break;
                                case 'valoracion':
                                    $valoracionController->getValoracion();
                                    break;
                                case 'usuarios':
                                    $usuarioController->getusuarios();
                                    break;
                                case 'usuario':
                                    $usuarioController->getUsuario();
                                    break;
                            }
                        }
                        break;
                    case 'bd':
                        if (isset($arguments[1])) {
                            switch ($arguments[1]) {
                                case 'bar':
                                    if (isset($arguments[2])) {
                                        switch ($arguments[2]) {
                                            case 'alta':
                                                $barController->alta();
                                                break;
                                            case 'baja':
                                                $barController->baja();
                                                break;
                                            case 'modificacion':
                                                $barController->modificacion();
                                                break;
                                        }
                                    }
                                    break;
                                case 'pincho':
                                    if (isset($arguments[2])) {
                                        switch ($arguments[2]) {
                                            case 'alta':
                                                $pinchoController->alta();
                                                break;
                                            case 'baja':
                                                $pinchoController->baja();
                                                break;
                                            case 'modificacion':
                                                $pinchoController->modificacion();
                                                break;
                                        }
                                    }
                                    break;
                                case 'valoracion':
                                    if (isset($arguments[2])) {
                                        switch ($arguments[2]) {
                                            case 'alta':
                                                $valoracionController->alta();
                                                break;
                                            case 'baja':
                                                $valoracionController->baja();
                                                break;
                                            case 'modificacion':
                                                $valoracionController->modificacion();
                                                break;
                                        }
                                    }
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
                                        }
                                    }
                                    break;
                            }
                        }
                    default:
                        require("view/404.php");
                }
        }
    }
} else {
    $usuarioController->index();
}
