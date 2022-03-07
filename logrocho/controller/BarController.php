<?php

require_once "bd.php";
require_once "model/Pincho.php";
require_once "model/Bar.php";

/**
 * @author Valentin Castravete <valentincastravete@gmail.com>
 */
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
            echo bd::insertBar($bar);
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
            bd::eliminarBar($id, false);
        }
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
    }

    /**
     * Devuelve bares en json
     */
    public function getBares()
    {
        header('Content-Type: application/json');

        $campos_requeridos = (isset($_GET['pagina']) && isset($_GET['cantidad']));
        if ($campos_requeridos) {
            if (isset($_GET['order_by']) && isset($_GET['asc_desc'])) {
                $pagina = $_GET['pagina'];
                $cantidad = $_GET['cantidad'];
                $index = ($pagina - 1) * $cantidad;
                $order_by = $_GET['order_by'];
                $asc_desc = $_GET['asc_desc'];
                $bares = Bar::arrayBares($index, $cantidad, $order_by, $asc_desc);
                echo json_encode($bares);
            } else if (isset($_GET['busqueda'])) {
                $pagina = $_GET['pagina'];
                $cantidad = $_GET['cantidad'];
                $index = ($pagina - 1) * $cantidad;
                $busqueda = $_GET['busqueda'];
                $bares = Bar::arrayBaresFiltrados($index, $cantidad, $busqueda);
                echo json_encode($bares);
            }
        }
    }

    /**
     * Devuelve los ids y nombres de todos los bares en json
     */
    public function getTodosLosBares()
    {
        header('Content-Type: application/json');

        echo json_encode(Bar::arrayTodosLosBares());
    }

    /**
     * Devuelve la cantidad maxima de bares
     */
    public function getCountBares()
    {
        echo bd::maxBares()->fetch(PDO::FETCH_ASSOC)["count(id)"];
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
            echo json_encode([$bar]);
        }
    }

    public function getImgsBar()
    {
        header('Content-Type: application/json');

        $campos_requeridos = (isset($_GET['id_bar']));
        if ($campos_requeridos) {
            $id_bar = isset($_GET['id_bar']);
            $rutas = [];
            foreach (bd::getImagenesBar($id_bar)->fetchAll(PDO::FETCH_ASSOC) as $ruta_img) {
                array_push($rutas, [$ruta_img['ruta']]);
            }
            echo json_encode($rutas);
        }
    }

    /**
     * Almacena imagen de un bar
     */
    public function setImg()
    {
        $campos_requeridos = (isset($_POST['id']) && isset($_FILES['files']));
        if ($campos_requeridos) {
            $id = $_POST['id'];

            $dir = 'view/img/bares/' . $id;
            if (!file_exists($dir) && !is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            if (is_string($_FILES["files"]["name"])) {
                $tmp_name = $_FILES["files"]["tmp_name"];
                $name = basename($_FILES["files"]["name"]);
                bd::query("INSERT INTO imagen_bar (id_bar, ruta) VALUES (?, ?)", [$id, "$dir/$name"]);
                move_uploaded_file($tmp_name, "$dir/$name");
            } else {
                foreach ($_FILES["files"]["error"] as $key => $error) {
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $_FILES["files"]["tmp_name"][$key];
                        $name = basename($_FILES["files"]["name"][$key]);
                        bd::query("INSERT INTO imagen_bar (id_bar, ruta) VALUES (?, ?)", [$id, "$dir/$name"]);
                        move_uploaded_file($tmp_name, "$dir/$name");
                    }
                }
            }
        }
    }
}
