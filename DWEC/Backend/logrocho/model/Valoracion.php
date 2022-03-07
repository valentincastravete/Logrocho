<?php

require_once "bd.php";

/**
 * @author Valentin Castravete <valentincastravete@gmail.com>
 */
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

    /**
     * Convierte lo que devuelve la consulta a base de datos a un array de objetos
     *
     * @param integer $index Indice desde el que empezar a buscar
     * @param integer $cantidad Cantidad de registros a buscar
     * @return array Array de objetos
     */
    public static function arrayValoraciones(int $index, int $cantidad, $order_by, $asc_desc) : array
    {
        $valoraciones = [];
        foreach (bd::getValoraciones($index, $cantidad, $order_by, $asc_desc)->fetchAll(PDO::FETCH_ASSOC) as $valoracion) {
            $id = $valoracion['id'];
            $id_usuario = $valoracion['id_usuario'];
            $id_pincho = $valoracion['id_pincho'];
            $descripcion = $valoracion['descripcion'];
            $calificacion = $valoracion['calificacion'];
            array_push($valoraciones, new Valoracion($id, $id_usuario, $id_pincho, $descripcion, $calificacion));
        }
        return $valoraciones;
    }

    /**
     * Devuelve un registro buscando por id
     *
     * @param integer $id Id del registro a buscar
     * @param boolean $isSha1 Si el id esta en sha1
     * @return Valoracion Objeto devuelto
     */
    public static function getValoracion(int $id, bool $isSha1) : Valoracion
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
