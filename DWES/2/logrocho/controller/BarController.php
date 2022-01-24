<?php

require_once "bd.php";
require_once "model/Pincho.php";
require_once "model/Bar.php";

class BarController
{
    /**
     * Alta de un bar
     */
    public function alta(Bar $bar)
    {
        $campos_requeridos = (isset($_POST['nombre']) && isset($_POST['direccion']) && isset($_POST['terraza']) && isset($_POST['latitud']) && isset($_POST['longitud']));
        if ($campos_requeridos) {
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $terraza = $_POST['terraza'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];
            $bar = [$nombre, $direccion, $terraza, $latitud, $longitud];
            bd::insertBar($bar);
            header("Location: " . getHome() . "bares");
        }
        require("view/bares.php");
    }

    /**
     * Eliminar un pincho
     */
    public function baja(int $id)
    {
        $campos_requeridos = (isset($_POST['id']));
        if ($campos_requeridos) {
            $id = $_POST['id'];
            bd::eliminarBar($id, false);
            header("Location: " . getHome() . "bares");
        }
        require("view/bares.php");
    }

    /**
     * Devuelve bares en json
     */
    public function getBares()
    {
        header('Content-Type: application/json');

        $campos_requeridos = (isset($_POST['pagina']) && isset($_POST['cantidad']));
        if ($campos_requeridos) {
            $pagina = $_POST['pagina'];
            $cantidad = $_POST['cantidad'];
            $index = ($pagina - 1) * $cantidad;
            $bares = Bar::arrayBares($index, $cantidad);
            echo json_encode(['bares' => $bares]);
        }
    }

    /**
     * Devuelve un bar en json
     */
    public function getBar()
    {
        header('Content-Type: application/json');

        $campos_requeridos = (isset($_POST['id']));
        if ($campos_requeridos) {
            $id = $_POST['id'];
            $bar = Bar::getBar($id, false);
            echo json_encode(['bar' => $bar]);
        }
    }
}
