<?php

require_once "bd.php";

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

    public static function arrayUsuarios(int $index, int $cantidad)
    {
        $usuarios = [];
        foreach (bd::getUsuarios($index, $cantidad)->fetchAll(PDO::FETCH_ASSOC) as $usuario) {
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

    public static function getUsuario(int $id, bool $isSha1)
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
