<?php

require_once "bd.php";
require_once "model/Usuario.php";

class UsuarioController
{

    /**
     * Home dependiendo del usuario que ha iniciado sesion
     */
    public function index()
    {
        redirectRespectiveHome();
    }

    /**
     * Login del usuario
     */
    public function login()
    {
        if (isLoggedIn()) {
            redirectRespectiveHome();
        }
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $user = [$_POST["email"], $_POST["password"]];
            $verifiedUser = bd::getUsuarioByCorreoYClave($user[0], $user[1]);
            if (get_class($verifiedUser) === "PDOStatement" && $verifiedUser->rowCount() === 1) {
                $loginUser = $verifiedUser->fetch(PDO::FETCH_ASSOC);
                $id = $loginUser["id"];
                $correo = $loginUser["correo"];
                $admin = $loginUser["admin"];
                $_SESSION["user"] = [sha1($id), $correo, $admin];
                redirectRespectiveHome();
            } else {
                header("Location: " . getAbsolutePath() . "login?error=true");
            }
        } else {
            require("view/login.php");
        }
    }

    /**
     * Cerrar sesion
     */
    public function cerrarSesion()
    {
        if (isset($_SESSION['user'])) {
            session_destroy();
        }
        header("Location: " . getHome());
    }

    /**
     * Validación de clave
     */
    public static function validacionesAlta($correo, $clave)
    {
        return filter_var($correo, FILTER_VALIDATE_EMAIL) && preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $clave);
    }

    /**
     * Alta de un usuario
     */
    public function alta()
    {
        $campos_requeridos = (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['clave']) && isset($_POST['admin']) && isset($_POST['ruta_imagen']));
        if ($campos_requeridos && UsuarioController::validacionesAlta($_POST['correo'], $_POST['clave'])) {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];
            $admin = $_POST['admin'];
            $ruta_imagen = $_POST['ruta_imagen'];
            $usuario = [$nombre, $correo, $clave, $admin, $ruta_imagen];
            bd::insertUsuario($usuario);
            require("view/usuarios.php");
        } else {
            # Notificar de validacion incorrecta
        }
    }

    /**
     * Eliminar un usuario
     */
    public function baja()
    {
        $campos_requeridos = (isset($_POST['id']));
        if ($campos_requeridos) {
            $id = $_POST['id'];
            bd::eliminarUsuario($id, false);
        }
        require("view/usuarios.php");
    }

    /**
     * Modificacion de un usuario
     */
    public function modificacion()
    {
        $campos_requeridos = (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['clave']) && isset($_POST['admin']) && isset($_POST['ruta_imagen']) && isset($_POST['id']));
        if ($campos_requeridos) {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];
            $admin = $_POST['admin'];
            $ruta_imagen = $_POST['ruta_imagen'];
            $id = $_POST['id'];
            $usuario = [$nombre, $correo, $clave, $admin, $ruta_imagen, $id];
            bd::updateUsuario($usuario, false);
        }
        require("view/usuarios.php");
    }

    /**
     * Devuelve usuarios en json
     */
    public function getUsuarios()
    {
        header('Content-Type: application/json');

        $campos_requeridos = (isset($_GET['pagina']) && isset($_GET['cantidad']));
        if ($campos_requeridos) {
            $pagina = $_GET['pagina'];
            $cantidad = $_GET['cantidad'];
            $index = ($pagina - 1) * $cantidad;
            $usuarios = Usuario::arrayUsuarios($index, $cantidad);
            echo json_encode(['usuarios' => $usuarios]);
        }
    }

    /**
     * Devuelve un usuario en json
     */
    public function getUsuario()
    {
        header('Content-Type: application/json');

        $campos_requeridos = (isset($_GET['id']));
        if ($campos_requeridos) {
            $id = $_GET['id'];
            $usuario = Usuario::getUsuario($id, false);
            echo json_encode(['usuario' => $usuario]);
        }
    }
}
