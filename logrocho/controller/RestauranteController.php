<?php

require_once "bd.php";

class RestauranteController
{
    /**
     * Login del usuario
     */
    public function index()
    {
        if (isset($_SESSION['user'])) {
            header("Location: " . getAbsolutePath() . "categorias");
        }
        if (isset($_POST["user"]) && isset($_POST["password"])) {
            $user = [$_POST["user"], $_POST["password"]];
            $verifiedUser = bd::getRestauranteByCorreoYClave($user[0], $user[1]);
            if (get_class($verifiedUser) === "PDOStatement" && $verifiedUser->rowCount() === 1) {
                $loginUser = $verifiedUser->fetch(PDO::FETCH_ASSOC);
                $codRes = $loginUser["cod_res"];
                $correo = $loginUser["correo"];
                $_SESSION["user"] = [sha1($codRes), $correo];
                $_SESSION["carrito"] = [];
                header("Location: " . getAbsolutePath() . "categorias");
            } else {
                header("Location: " . getAbsolutePath() . "login?error=true");
            }
        }

        require("view/login.php");
    }

    /**
     * Cerrar sesion
     */
    public function logout()
    {
        if (isset($_SESSION['user'])) {
            session_destroy();
        }
        header("Location: " . getHome());
    }

    /**
     * Registro de nuevo usuario
     */
    public function registro()
    {
        $requiredSet = (isset($_POST['user']) && isset($_POST['password']));
        if ($requiredSet) {
            $mail = $_POST['user'];
            $sqlExistingUser = "SELECT cod_res FROM RESTAURANTE WHERE correo = ?;";
            $existingUser = bd::query($sqlExistingUser, [$mail]);
            if (get_class($existingUser) === "PDOStatement" && $existingUser->rowCount() === 1) {
                header("Location: " . getHome() . "registro?error=true");
            } else {
                $key = sha1($_POST['password']);
                $address = $_POST['address'];
                $cp = $_POST['cp'];
                $country = $_POST['country'];
                $user = [$mail, $key, $address, $cp, $country];
                $sqlRegisterUser = "INSERT INTO RESTAURANTE (correo, clave, direccion, cp, pais) VALUES (?, ?, ?, ?, ?);";
                $codRes = bd::query($sqlRegisterUser, $user);

                if (!isset($_SESSION['user'])) {
                    unset($_SESSION['user']);
                }
                $_SESSION['user'] = [sha1($codRes), $mail];
                $_SESSION['carrito'] = [];
                header("Location: " . getHome() . "categorias");
            }
        }
        require("view/registro.php");
    }

    /**
     * Envia mail al correo indicado para cambiar contrasena
     */
    public function recordar_contrasena()
    {
        if (isset($_POST['user'])) {
            $mail = $_POST['user'];
            $sql = "SELECT cod_res FROM RESTAURANTE WHERE correo = ?;";
            $existingUser = bd::query($sql, [$mail]);
        
            if (get_class($existingUser) === "PDOStatement" && $existingUser->rowCount() === 1) {
                $cod_res = $existingUser->fetch(PDO::FETCH_ASSOC)['cod_res'];
                enviarMail(
                    "valenpeke2@gmail.com",
                    file_get_contents("composer"),
                    $mail,
                    "Cambiar contraseña",
                    "En el siguiente enlace puede cambiar su contraseña: <a href='" . getAbsolutePath() . "generar_contrasena?id=" . sha1($cod_res) . "'>Cambiar contraseña</a> .<br>"
                );
                header("Location: " . getHome() . "recordar_contrasena?sent=true");
            } else {
                header("Location: " . getHome() . "recordar_contrasena?error=true");
            }
        }
        require("view/reset_password.php");
    }

    /**
     * Genera una nueva contrasena para el correo indicado
     */
    public function generar_contrasena()
    {
        if (isset($_GET['id'])) {
            if (!isset($_POST['clave'])) {
                $sha1_cod_res = $_GET['id'];
                $sql = "SELECT cod_res, correo FROM RESTAURANTE WHERE sha1(cod_res) = ?;";
                $existingUser = bd::query($sql, [$sha1_cod_res]);
        
                if (get_class($existingUser) !== "PDOStatement" || $existingUser->rowCount() < 1) {
                    header("Location: " . getHome() . "categorias");
                } else {
                    $cod_res = $existingUser->fetch(PDO::FETCH_ASSOC)["cod_res"];
                    setcookie('cod_res', $cod_res);
                }
            } else {
                $clave = $_POST['clave'];
                $cod_res = $_COOKIE['cod_res'];
                if (isset($cod_res)) {
                    $sql = "UPDATE RESTAURANTE SET Clave = ? WHERE cod_res = ?;";
                    bd::query($sql, [sha1($clave), $cod_res]);
                    unset($_COOKIE['cod_res']);
                    header("Location: " . getHome());
                } else {
                    header("Location: " . getHome() . "categorias");
                }
            }
        } else {
            header("Location: " . getHome() . "categorias");
        }
        require("view/generar_contrasena.php");
    }
}
