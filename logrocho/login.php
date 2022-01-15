<?php
session_start();
require_once "bd.php";

if (isset($_SESSION['user'])) {
    echo $_SESSION["user"][1];
    die;
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
        echo $_SESSION["user"][1];
        die;
    }
}

echo false;
