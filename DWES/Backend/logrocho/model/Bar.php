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
     * Convierte lo que devuelve la consulta a base de datos a un array de bares
     *
     * @param integer $index
     * @param integer $cantidad
     * @return array Arrayd de bares
     */
    public static function arrayBares(int $index, int $cantidad) : array
    {
        $bares = [];
        foreach (bd::getBares($index, $cantidad)->fetchAll(PDO::FETCH_ASSOC) as $bar) {
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

    public static function getBar(int $id, bool $isSha1)
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
