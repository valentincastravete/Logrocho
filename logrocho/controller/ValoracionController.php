<?php

require_once "bd.php";
require_once "model/Valoracion.php";

class ValoracionController
{
    /**
     * Alta de una valoracion
     */
    public function alta()
    {
        $campos_requeridos = (isset($_POST['id_usuario']) && isset($_POST['id_pincho']) && isset($_POST['descripcion']) && isset($_POST['calificacion']));
        if ($campos_requeridos) {
            $id_usuario = $_POST['id_usuario'];
            $id_pincho = $_POST['id_pincho'];
            $descripcion = $_POST['descripcion'];
            $calificacion = $_POST['calificacion'];
            $valoracion = [$id_usuario, $id_pincho, $descripcion, $calificacion];
            bd::insertValoracion($valoracion);
        }
        require("view/backend/valoraciones.php");
    }

    /**
     * Eliminar una valoracion
     */
    public function baja()
    {
        $campos_requeridos = (isset($_POST['id']));
        if ($campos_requeridos) {
            $id = $_POST['id'];
            bd::eliminarValoracion($id, false);
        }
        require("view/backend/valoraciones.php");
    }

    /**
     * Eliminar una valoracion de un usuario no administrador
     */
    public function bajaNoAdminUser()
    {
        $campos_requeridos = (isset($_POST['id_usuario']) && isset($_POST['id']));
        if ($campos_requeridos) {
            $idUsuario = $_POST['id_usuario'];
            $id = $_POST['id'];
            bd::eliminarValoracionDeUsuario($idUsuario, $id, false, false);
        }
        require("view/backend/valoraciones.php");
    }

    /**
     * Modificacion de una valoracion
     */
    public function modificacion()
    {
        $campos_requeridos = (isset($_POST['id_usuario']) && isset($_POST['id_pincho']) && isset($_POST['descripcion']) && isset($_POST['calificacion']) && isset($_POST['id']));
        if ($campos_requeridos) {
            $id_usuario = $_POST['id_usuario'];
            $id_pincho = $_POST['id_pincho'];
            $descripcion = $_POST['descripcion'];
            $calificacion = $_POST['calificacion'];
            $id = $_POST['id'];
            $valoracion = [$id_usuario, $id_pincho, $descripcion, $calificacion, $id];
            bd::updateValoracion($valoracion, false);
        }
        require("view/backend/valoraciones.php");
    }

    /**
     * Devuelve valoraciones en json
     */
    public function getValoraciones()
    {
        header('Content-Type: application/json');

        $campos_requeridos = (isset($_GET['pagina']) && isset($_GET['cantidad']));
        if ($campos_requeridos) {
            $pagina = $_GET['pagina'];
            $cantidad = $_GET['cantidad'];
            $index = ($pagina - 1) * $cantidad;
            $valoraciones = Valoracion::arrayValoraciones($index, $cantidad);
            echo json_encode(['valoraciones' => $valoraciones]);
        }
    }

    /**
     * Devuelve una valoracion en json
     */
    public function getValoracion()
    {
        header('Content-Type: application/json');

        $campos_requeridos = (isset($_GET['id']));
        if ($campos_requeridos) {
            $id = $_GET['id'];
            $valoracion = Valoracion::getValoracion($id, false);
            echo json_encode(['valoracion' => $valoracion]);
        }
    }
}
