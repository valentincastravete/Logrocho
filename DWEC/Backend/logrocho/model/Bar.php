<?php

require_once "bd.php";

/**
 * @author Valentin Castravete <valentincastravete@gmail.com>
 */
class Bar
{

    public $id, $nombre, $direccion, $terraza, $latitud, $longitud;

    function __construct(string $id, string $nombre, string $direccion, bool $terraza, float $latitud, float $longitud)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->terraza = $terraza;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
    }

    /**
     * Convierte lo que devuelve la consulta a base de datos a un array de objetos
     *
     * @param integer $index Indice desde el que empezar a buscar
     * @param integer $cantidad Cantidad de registros a buscar
     * @return array Array de objetos
     */
    public static function arrayBares(int $index, int $cantidad, int $order_by, bool $asc_desc) : array
    {
        $bares = [];
        foreach (bd::getBares($index, $cantidad, $order_by, $asc_desc)->fetchAll(PDO::FETCH_ASSOC) as $bar) {
            $id = $bar['id'];
            $nombre = $bar['nombre'];
            $direccion = $bar['direccion'];
            $terraza = $bar['terraza'];
            $latitud = $bar['latitud'];
            $longitud = $bar['longitud'];
            array_push($bares, new Bar($id, $nombre, $direccion, $terraza, $latitud, $longitud));
        }
        return $bares;
    }

    /**
     * Convierte lo que devuelve la consulta a base de datos a un array de objetos
     *
     * @return array Array de objetos
     */
    public static function arrayTodosLosBares() : array
    {
        $bares = [];
        foreach (bd::getTodosLosBares()->fetchAll(PDO::FETCH_ASSOC) as $bar) {
            $id = $bar['id'];
            $nombre = $bar['nombre'];
            array_push($bares, new Bar($id, $nombre, "", 0, 0, 0));
        }
        return $bares;
    }

    /**
     * Devuelve un registro buscando por id
     *
     * @param integer $id Id del registro a buscar
     * @param boolean $isSha1 Si el id esta en sha1
     * @return Bar Objeto devuelto
     */
    public static function getBar(int $id, bool $isSha1) : Bar
    {
        $bar = bd::getBar($id, $isSha1)->fetch(PDO::FETCH_ASSOC);
        $id = $bar['id'];
        $nombre = $bar['nombre'];
        $direccion = $bar['direccion'];
        $terraza = $bar['terraza'];
        $latitud = $bar['latitud'];
        $longitud = $bar['longitud'];
        return new Bar($id, $nombre, $direccion, $terraza, $latitud, $longitud);
    }
}
