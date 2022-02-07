<?php

require_once "bd.php";

/**
 * @author Valentin Castravete <valentincastravete@gmail.com>
 */
class MeGustaController
{
    /**
     * Alta de un me gusta
     */
    public function alta()
    {
        $campos_requeridos = (isset($_POST['id_usuario']) && isset($_POST['id_valoracion']));
        if ($campos_requeridos) {
            $id_usuario = $_POST['id_usuario'];
            $id_valoracion = $_POST['id_valoracion'];
            $meGusta = [$id_usuario, $id_valoracion];
            bd::insertMeGusta($meGusta);
        }
        header("Location: " . getIndex() . 'pinchos');
    }

    /**
     * Elimina un me gusta
     */
    public function baja()
    {
        $campos_requeridos = (isset($_POST['id']));
        if ($campos_requeridos) {
            $id = $_POST['id'];
            bd::eliminarMeGusta($id, false);
        }
        header("Location: " . getIndex() . 'pinchos');
    }

    /**
     * Eliminar todos los me gustas de un usuario no administrador
     */
    public function bajaMeGustasUsuario()
    {
        $campos_requeridos = (isset($_POST['id']));
        if ($campos_requeridos) {
            $id = $_POST['id'];
            bd::eliminarMeGustasDeUsuario($id, false);
        }
        header("Location: " . getIndex() . 'pinchos');
    }
}
