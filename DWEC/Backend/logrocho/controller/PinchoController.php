<?php

require_once "bd.php";
require_once "model/Pincho.php";
require_once "model/Bar.php";

/**
 * @author Valentin Castravete <valentincastravete@gmail.com>
 */
class PinchoController
{
    /**
     * Alta de un pincho
     */
    public function alta()
    {
        $campos_requeridos = (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['id_bar']));
        if ($campos_requeridos) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $id_bar = $_POST['id_bar'];
            $pincho = [$nombre, $descripcion, $id_bar];
            bd::insertPincho($pincho);
        }
    }

    /**
     * Eliminar un pincho
     */
    public function baja()
    {
        $campos_requeridos = (isset($_POST['id']));
        if ($campos_requeridos) {
            $id = $_POST['id'];
            bd::elimnarPincho($id, false);
        }
    }

    /**
     * Modificacion de un pincho
     */
    public function modificacion()
    {
        $campos_requeridos = (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['id_bar']) && isset($_POST['id']));
        if ($campos_requeridos) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $id_bar = $_POST['id_bar'];
            $id = $_POST['id'];
            $pincho = [$nombre, $descripcion, $id_bar, $id];
            bd::updatePincho($pincho, false);
        }
    }

    /**
     * Devuelve pinchos en json
     */
    public function getPinchos()
    {
        header('Content-Type: application/json');

        $campos_requeridos = (isset($_GET['pagina']) && isset($_GET['cantidad']) && isset($_GET['order_by']) && isset($_GET['asc_desc']));
        if ($campos_requeridos) {
            $pagina = $_GET['pagina'];
            $cantidad = $_GET['cantidad'];
            $index = ($pagina - 1) * $cantidad;
            $order_by = $_GET['order_by'];
            $asc_desc = $_GET['asc_desc'];
            $pinchos = Pincho::arrayPinchos($index, $cantidad, $order_by, $asc_desc);
            echo json_encode($pinchos);
        }
    }

    /**
     * Devuelve los ids y nombres de todos los bares en json
     */
    public function getTodosLosPinchos()
    {
        header('Content-Type: application/json');

        echo json_encode(Pincho::arrayTodosLosPinchos());
    }

    /**
     * Devuelve la cantidad maxima de pinchos
     */
    public function getCountPinchos()
    {
        echo bd::maxPinchos()->fetch(PDO::FETCH_ASSOC)["count(id)"];
    }

    /**
     * Devuelve un pincho en json
     */
    public function getPincho()
    {
        header('Content-Type: application/json');

        $campos_requeridos = (isset($_GET['id']));
        if ($campos_requeridos) {
            $id = $_GET['id'];
            $pincho = Pincho::getPincho($id, false);
            echo json_encode([$pincho]);
        }
    }

    /**
     * Almacena imagen de un pincho
     */
    public function setImg()
    {
        $campos_requeridos = (isset($_POST['id']) && isset($_FILES['files']));
        if ($campos_requeridos) {
            $id = $_POST['id'];

            $dir = 'view/img/pinchos/' . $id;
            if (!file_exists($dir) && !is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            if (is_string($_FILES["files"]["name"])) {
                $tmp_name = $_FILES["files"]["tmp_name"];
                $name = basename($_FILES["files"]["name"]);
                bd::query("INSERT INTO imagen_pincho (id_pincho, ruta) VALUES (?, ?)", [$id, "$dir/$name"]);
                move_uploaded_file($tmp_name, "$dir/$name");
            } else {
                foreach ($_FILES["files"]["error"] as $key => $error) {
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["files"]["tmp_name"][$key];
                        $name = basename($_FILES["files"]["name"][$key]);
                        bd::query("INSERT INTO imagen_pincho (id_pincho, ruta) VALUES (?, ?)", [$id, "$dir/$name"]);
                        move_uploaded_file($tmp_name, "$dir/$name");
                    }
                }
            }
        }
    }
}
