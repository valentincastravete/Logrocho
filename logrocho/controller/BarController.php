<?php

require_once "bd.php";
require_once "model/Pincho.php";
require_once "model/Bar.php";

class BarController
{
    /**
     * Alta de un bar
     */
    public function alta()
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
        }
        require("view/backend/bares.php");
    }

    /**
     * Eliminar un pincho
     */
    public function baja()
    {
        $campos_requeridos = (isset($_POST['id']));
        if ($campos_requeridos) {
            $id = $_POST['id'];
            bd::eliminarBar($id, false);
        }
        require("view/backend/bares.php");
    }

    /**
     * Modificacion de un bar
     */
    public function modificacion()
    {
        $campos_requeridos = (isset($_POST['nombre']) && isset($_POST['direccion']) && isset($_POST['terraza']) && isset($_POST['latitud']) && isset($_POST['longitud']) && isset($_POST['id']));
        if ($campos_requeridos) {
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $terraza = $_POST['terraza'];
            $latitud = $_POST['latitud'];
            $longitud = $_POST['longitud'];
            $id = $_POST['id'];
            $bar = [$nombre, $direccion, $terraza, $latitud, $longitud, $id];
            bd::updateBar($bar, false);
        }
        require("view/backend/bares.php");
    }

    /**
     * Devuelve bares en json
     */
    public function getBares()
    {
        header('Content-Type: application/json');

        $campos_requeridos = (isset($_GET['pagina']) && isset($_GET['cantidad']));
        if ($campos_requeridos) {
            $pagina = $_GET['pagina'];
            $cantidad = $_GET['cantidad'];
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

        $campos_requeridos = (isset($_GET['id']));
        if ($campos_requeridos) {
            $id = $_GET['id'];
            $bar = Bar::getBar($id, false);
            echo json_encode(['bar' => $bar]);
        }
    }

    /**
     * Almacena imagen de un bar
     */
    public function setBarImg() {
        $campos_requeridos = (isset($_GET['id']) && isset($_FILES['img']));
        if ($campos_requeridos) {
            $pagidina = $_GET['id'];
            $img = $_FILES['img'];
            $img_name = $_GET['img_name'];
            $img_file = $_GET['img_file'];
            
        }
    }
}
