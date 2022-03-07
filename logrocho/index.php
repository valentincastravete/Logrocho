<?php
session_start();

require_once "controller/UsuarioController.php";
require_once "controller/BarController.php";
require_once "controller/PinchoController.php";
require_once "controller/ValoracionController.php";
require_once "controller/MeGustaController.php";
require_once "utils.php";

$usuarioController = new UsuarioController;
$barController = new BarController;
$pinchoController = new PinchoController;
$valoracionController = new ValoracionController;
$meGustaController = new MeGustaController;
$arguments = getArguments();
$hasArguments = (count($arguments) > 0);

$paginaBackendActual = 0;
$paginasBackend = ['bares' => 0, 'pinchos' => 1, 'valoraciones' => 2, 'usuarios' => 3, 'contacto' => 4];

/**
 * Redirige al controlador correspondiente dependiendo de la URL
 */
if ($hasArguments && isset($arguments[0])) {
    if (!isLoggedIn() && !in_array($arguments[0], ["login", "recuperar_cuenta", "home", "bares", "bar", "pincho", "pinchos", "valoracion", "contacto", "registro", "openapi"])) {
        include_once("view/404.php");
    } else {
        if (isLoggedIn() && !isAdminLoggedIn() &&
            (in_array($arguments[0], ["admin"]) ||
                (isset($arguments[1]) && in_array($arguments[1], ["usuarios", "usuario", "bares", "pinchos", "valoraciones", "usuarios", "bd"])))
        ) {
            include_once("view/404.php");
        } else {
            if ($arguments[0])
                switch ($arguments[0]) {
                    case 'login':
                        $usuarioController->login();
                        break;
                    case 'recuperar_cuenta':
                        include_once("view/recuperar_cuenta.php");
                        break;
                    case 'cerrar_sesion':
                        $usuarioController->cerrarSesion();
                        break;
                    case 'bares':
                        $paginaBackendActual = 0;
                        include_once("view/bares.php");
                        break;
                    case 'pinchos':
                        $paginaBackendActual = 1;
                        require("view/pinchos.php");
                        break;
                    case 'bar':
                        $paginaBackendActual = 0;
                        include_once("view/bar.php");
                        break;
                    case 'pincho':
                        $paginaBackendActual = 1;
                        include_once("view/pincho.php");
                        break;
                    case 'valoracion':
                        $paginaBackendActual = 2;
                        include_once("view/valoracion.php");
                        break;
                    case 'contacto':
                        $paginaBackendActual = 4;
                        require("view/contacto.php");
                        break;
                    case 'registro':
                        $usuarioController->registro();
                        break;
                    case 'admin':
                        if (isset($arguments[1])) {
                            switch ($arguments[1]) {
                                case 'bares':
                                    $paginaBackendActual = 0;
                                    include_once("view/backend/bares.php");
                                    break;
                                case 'pinchos':
                                    $paginaBackendActual = 1;
                                    require("view/backend/pinchos.php");
                                    break;
                                case 'valoraciones':
                                    $paginaBackendActual = 2;
                                    include_once("view/backend/valoraciones.php");
                                    break;
                                case 'usuarios':
                                    $paginaBackendActual = 3;
                                    include_once("view/backend/usuarios.php");
                                    break;
                                case 'bar':
                                    $paginaBackendActual = 0;
                                    include_once("view/backend/bar.php");
                                    break;
                                case 'pincho':
                                    $paginaBackendActual = 1;
                                    include_once("view/backend/pincho.php");
                                    break;
                                case 'valoracion':
                                    $paginaBackendActual = 2;
                                    include_once("view/backend/valoracion.php");
                                    break;
                                case 'usuario':
                                    $paginaBackendActual = 3;
                                    include_once("view/backend/usuario.php");
                                    break;
                                default:
                                    include_once("view/404.php");
                            }
                        }
                        break;
                    case 'openapi':
                        if (isset($arguments[1])) {
                            switch ($arguments[1]) {
                                case 'imgs_bar':
                                    $barController->getImgsBar();
                                    break;
                                case 'bares':
                                    $barController->getBares();
                                    break;
                                case 'all_bares':
                                    $barController->getTodosLosBares();
                                    break;
                                case 'count_bares':
                                    $barController->getCountBares();
                                    break;
                                case 'bar':
                                    $barController->getBar();
                                    break;
                                case 'pinchos':
                                    $pinchoController->getPinchos();
                                    break;
                                case 'all_pinchos':
                                    $pinchoController->getTodosLosPinchos();
                                    break;
                                case 'count_pinchos':
                                    $pinchoController->getCountPinchos();
                                    break;
                                case 'pincho':
                                    $pinchoController->getPincho();
                                    break;
                                case 'valoraciones':
                                    $valoracionController->getValoraciones();
                                    break;
                                case 'count_valoraciones':
                                    $valoracionController->getCountValoraciones();
                                    break;
                                case 'valoracion':
                                    $valoracionController->getValoracion();
                                    break;
                                case 'usuario':
                                    $usuarioController->getUsuario();
                                    break;
                                default:
                                    include_once("view/404.php");
                            }
                        }
                        break;
                    case 'api':
                        if (isset($arguments[1])) {
                            switch ($arguments[1]) {
                                case 'bares':
                                    $barController->getBares();
                                    break;
                                case 'all_bares':
                                    $barController->getTodosLosBares();
                                    break;
                                case 'count_bares':
                                    $barController->getCountBares();
                                    break;
                                case 'bar':
                                    $barController->getBar();
                                    break;
                                case 'pinchos':
                                    $pinchoController->getPinchos();
                                    break;
                                case 'all_pinchos':
                                    $pinchoController->getTodosLosPinchos();
                                    break;
                                case 'count_pinchos':
                                    $pinchoController->getCountPinchos();
                                    break;
                                case 'pincho':
                                    $pinchoController->getPincho();
                                    break;
                                case 'valoraciones':
                                    $valoracionController->getValoraciones();
                                    break;
                                case 'count_valoraciones':
                                    $valoracionController->getCountValoraciones();
                                    break;
                                case 'valoracion':
                                    $valoracionController->getValoracion();
                                    break;
                                case 'usuarios':
                                    $usuarioController->getusuarios();
                                    break;
                                case 'all_usuarios':
                                    $usuarioController->getTodosLosUsuarios();
                                    break;
                                case 'count_usuarios':
                                    $usuarioController->getCountUsuarios();
                                    break;
                                case 'usuario':
                                    $usuarioController->getUsuario();
                                    break;
                                default:
                                    include_once("view/404.php");
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
                                            case 'set-img':
                                                $barController->setImg();
                                                break;
                                            default:
                                                include_once("view/404.php");
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
                                            case 'set-img':
                                                $pinchoController->setImg();
                                                break;
                                            default:
                                                include_once("view/404.php");
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
                                            case 'baja_no_admin_user':
                                                $valoracionController->bajaNoAdminUser();
                                                break;
                                            case 'modificacion':
                                                $valoracionController->modificacion();
                                                break;
                                            default:
                                                include_once("view/404.php");
                                        }
                                    }
                                    break;
                                case 'usuario':
                                    if (isset($arguments[2])) {
                                        switch ($arguments[2]) {
                                            case 'alta':
                                                $usuarioController->alta();
                                                break;
                                            case 'baja':
                                                $usuarioController->baja();
                                                break;
                                            case 'modificacion':
                                                $usuarioController->modificacion();
                                                break;
                                            case 'set-img':
                                                $usuarioController->setImg();
                                                break;
                                            default:
                                                include_once("view/404.php");
                                        }
                                    }
                                    break;
                                case 'me_gusta':
                                    if (isset($arguments[2])) {
                                        switch ($arguments[2]) {
                                            case 'alta':
                                                $meGustaController->alta();
                                                break;
                                            case 'baja':
                                                $meGustaController->baja();
                                                break;
                                            case 'baja_total':
                                                $meGustaController->bajaMeGustasUsuario();
                                                break;
                                            default:
                                                include_once("view/404.php");
                                        }
                                    }
                                    break;
                                default:
                                    include_once("view/404.php");
                            }
                        }
                        break;
                    default:
                        include_once("view/404.php");
                }
        }
    }
} else {
    include_once("view/home.php");
}
