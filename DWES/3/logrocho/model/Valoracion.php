<?php

require_once "bd.php";

class Valoracion
{

    public $id, $id_usuario, $id_pincho, $descripcion, $calificacion;

    function __construct(int $id, int $id_usuario, int $id_pincho, string $descripcion, int $calificacion)
    {
        $this->id = $id;
        $this->id_usuario = $id_usuario;
        $this->id_pincho = $id_pincho;
        $this->descripcion = $descripcion;
        $this->calificacion = $calificacion;
    }

    public static function arrayValoraciones(int $index, int $cantidad)
    {
        $valoraciones = [];
        foreach (bd::getValoraciones($index, $cantidad)->fetchAll(PDO::FETCH_ASSOC) as $valoracion) {
            $id = $valoracion['id'];
            $id_usuario = $valoracion['id_usuario'];
            $id_pincho = $valoracion['id_pincho'];
            $descripcion = $valoracion['descripcion'];
            $calificacion = $valoracion['calificacion'];
            array_push($valoraciones, new Valoracion($id, $id_usuario, $id_pincho, $descripcion, $calificacion));
        }
        return $valoraciones;
    }

    public static function getValoracion(int $id, bool $isSha1)
    {
        $valoracion = bd::getValoracion($id, $isSha1)->fetch(PDO::FETCH_ASSOC);
        $id = $valoracion['id'];
        $id_usuario = $valoracion['id_usuario'];
        $id_pincho = $valoracion['id_pincho'];
        $descripcion = $valoracion['descripcion'];
        $calificacion = $valoracion['calificacion'];
        return new Valoracion($id, $id_usuario, $id_pincho, $descripcion, $calificacion);
    }
}
