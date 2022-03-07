<?php

require_once "bd.php";

/**
 * @author Valentin Castravete <valentincastravete@gmail.com>
 */
class Usuario
{

    public $id, $nombre, $correo, $clave, $admin, $ruta_imagen;

    function __construct(int $id, string $nombre, string $correo, string $clave, bool $admin, string $ruta_imagen)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->clave = $clave;
        $this->admin = $admin;
        $this->ruta_imagen = $ruta_imagen;
    }

    /**
     * Convierte lo que devuelve la consulta a base de datos a un array de objetos
     *
     * @param integer $index Indice desde el que empezar a buscar
     * @param integer $cantidad Cantidad de registros a buscar
     * @return array Array de objetos
     */
    public static function arrayUsuarios(int $index, int $cantidad, $order_by, $asc_desc) : array
    {
        $usuarios = [];
        foreach (bd::getUsuarios($index, $cantidad, $order_by, $asc_desc)->fetchAll(PDO::FETCH_ASSOC) as $usuario) {
            $id = $usuario['id'];
            $nombre = $usuario['nombre'];
            $correo = $usuario['correo'];
            $clave = $usuario['clave'];
            $admin = $usuario['admin'];
            $ruta_imagen = $usuario['ruta_imagen'];
            array_push($usuarios, new Usuario($id, $nombre, $correo, $clave, $admin, $ruta_imagen));
        }
        return $usuarios;
    }

    /**
     * Convierte lo que devuelve la consulta a base de datos a un array de objetos
     *
     * @return array Array de objetos
     */
    public static function arrayTodosLosUsuarios() : array
    {
        $usuarios = [];
        foreach (bd::getTodosLosUsuarios()->fetchAll(PDO::FETCH_ASSOC) as $usuario) {
            $id = $usuario['id'];
            $nombre = $usuario['nombre'];
            array_push($usuarios, new Bar($id, $nombre, "", 0, 0, 0));
        }
        return $usuarios;
    }

    /**
     * Devuelve un registro buscando por id
     *
     * @param integer $id Id del registro a buscar
     * @param boolean $isSha1 Si el id esta en sha1
     * @return Usuario Objeto devuelto
     */
    public static function getUsuario(int $id, bool $isSha1) : Usuario
    {
        $usuario = bd::getUsuario($id, $isSha1)->fetch(PDO::FETCH_ASSOC);
        $id = $usuario['id'];
        $nombre = $usuario['nombre'];
        $correo = $usuario['correo'];
        $clave = $usuario['clave'];
        $admin = $usuario['admin'];
        $ruta_imagen = $usuario['ruta_imagen'];
        return new Usuario($id, $nombre, $correo, $clave, $admin, $ruta_imagen);
    }
}
