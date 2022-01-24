<?php

require_once "bd.php";
require_once "model/Pincho.php";
require_once "model/Bar.php";

class PinchoController
{
    /**
     * Alta de un pincho
     */
    public function alta(Pincho $pincho)
    {
        $campos_requeridos = (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['bar']));
        if ($campos_requeridos) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $id_bar = $_POST['id_bar'];
            $bar = bd::getBar($id_bar, false);
            $pincho = [$nombre, $descripcion, $bar];
            bd::insertPincho($pincho);
            header("Location: " . getHome() . "pinchos");
        }
        require("view/pinchos.php");
    }

    /**
     * Eliminar un pincho
     */
    public function baja(int $id)
    {
        $campos_requeridos = (isset($_POST['id']));
        if ($campos_requeridos) {
            $id = $_POST['id'];
            bd::elimnarPincho($id, false);
            header("Location: " . getHome() . "pinchos");
        }
        require("view/pinchos.php");
    }

    /**
     * Devuelve pinchos en json
     */
    public function getPinchos()
    {
        header('Content-Type: application/json');

        $campos_requeridos = (isset($_POST['pagina']) && isset($_POST['cantidad']));
        if ($campos_requeridos) {
            $pagina = $_POST['pagina'];
            $cantidad = $_POST['cantidad'];
            $index = ($pagina - 1) * $cantidad;
            $pinchos = Pincho::arrayPinchos($index, $cantidad);
            echo json_encode(['pinchos' => $pinchos]);
        }
    }

    /**
     * Devuelve un pincho en json
     */
    public function getPincho()
    {
        header('Content-Type: application/json');

        $campos_requeridos = (isset($_POST['id']));
        if ($campos_requeridos) {
            $id = $_POST['id'];
            $pincho = Pincho::getPincho($id, false);
            echo json_encode(['pincho' => $pincho]);
        }
    }
}
