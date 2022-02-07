<?php

require_once "bd.php";

class Pincho
{

    public $id, $nombre, $descripcion, $bar;

    function __construct(string $id, string $nombre, string $descripcion, Bar $bar)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->bar = $bar;
    }

    public static function arrayPinchos(int $index, int $cantidad)
    {
        $pinchos = [];
        foreach (bd::getPinchos($index, $cantidad)->fetchAll(PDO::FETCH_ASSOC) as $pincho) {
            $id = $pincho['id'];
            $nombre = $pincho['nombre'];
            $descripcion = $pincho['descripcion'];
            $bar = Bar::getBar($pincho['id_bar'], false);
            array_push($pinchos, new Pincho($id, $nombre, $descripcion, $bar));
        }
        return $pinchos;
    }

    public static function getPincho(int $id, bool $isSha1)
    {
        $pincho = bd::getPincho($id, $isSha1)->fetch(PDO::FETCH_ASSOC);
        $id = $pincho['id'];
        $nombre = $pincho['nombre'];
        $descripcion = $pincho['descripcion'];
        $bar = Bar::getBar($pincho['id_bar'], false);
        return new Pincho($id, $nombre, $descripcion, $bar);
    }
}
