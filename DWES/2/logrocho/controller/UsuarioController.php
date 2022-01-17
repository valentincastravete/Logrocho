<?php

require_once "bd.php";

class UsuarioController
{
    /**
     * Login del usuario
     */
    public function index()
    {
        if (isset($_SESSION['user'])) {
            header("Location: " . getAbsolutePath() . "logged");
        }
        if (isset($_POST["user"]) && isset($_POST["password"])) {
            $user = [$_POST["user"], $_POST["password"]];
            $verifiedUser = bd::getUsuarioByCorreoYClave($user[0], $user[1]);
            if (get_class($verifiedUser) === "PDOStatement" && $verifiedUser->rowCount() === 1) {
                $loginUser = $verifiedUser->fetch(PDO::FETCH_ASSOC);
                $id = $loginUser["id"];
                $correo = $loginUser["correo"];
                $admin = $loginUser["admin"];
                $_SESSION["user"] = [sha1($id), $correo, $admin];
                header("Location: " . getAbsolutePath());
            } else {
                header("Location: " . getAbsolutePath() . "login?error=true");
            }
        }
        require "view/login.php";
    }

    public function validacionClave($correo, $clave) {
        return !filter_var($correo, FILTER_VALIDATE_EMAIL) || !preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $clave);
    }
}
