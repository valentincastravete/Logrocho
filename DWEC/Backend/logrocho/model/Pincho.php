<?php

require_once "bd.php";

/**
 * @author Valentin Castravete <valentincastravete@gmail.com>
 */
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

    /**
     * Convierte lo que devuelve la consulta a base de datos a un array de objetos
     *
     * @param integer $index Indice desde el que empezar a buscar
     * @param integer $cantidad Cantidad de registros a buscar
     * @return array Array de objetos
     */
    public static function arrayPinchos(int $index, int $cantidad, int $order_by, bool $asc_desc) : array
    {
        $pinchos = [];
        foreach (bd::getPinchos($index, $cantidad, $order_by, $asc_desc)->fetchAll(PDO::FETCH_ASSOC) as $pincho) {
            $id = $pincho['id'];
            $nombre = $pincho['nombre'];
            $descripcion = $pincho['descripcion'];
            $bar = Bar::getBar($pincho['id_bar'], false);
            array_push($pinchos, new Pincho($id, $nombre, $descripcion, $bar));
        }
        return $pinchos;
    }

    /**
     * Convierte lo que devuelve la consulta a base de datos a un array de objetos
     *
     * @return array Array de objetos
     */
    public static function arrayTodosLosPinchos() : array
    {
        $pinchos = [];
        foreach (bd::getTodosLosPinchos()->fetchAll(PDO::FETCH_ASSOC) as $pincho) {
            $id = $pincho['id'];
            $nombre = $pincho['nombre'];
            array_push($pinchos, new Bar($id, $nombre, "", 0, 0, 0));
        }
        return $pinchos;
    }

    /**
     * Devuelve un registro buscando por id
     *
     * @param integer $id Id del registro a buscar
     * @param boolean $isSha1 Si el id esta en sha1
     * @return Pincho Objeto devuelto
     */
    public static function getPincho(int $id, bool $isSha1) : Pincho
    {
        $pincho = bd::getPincho($id, $isSha1)->fetch(PDO::FETCH_ASSOC);
        $id = $pincho['id'];
        $nombre = $pincho['nombre'];
        $descripcion = $pincho['descripcion'];
        $bar = Bar::getBar($pincho['id_bar'], false);
        return new Pincho($id, $nombre, $descripcion, $bar);
    }
}
