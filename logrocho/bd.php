<?php

class bd
{
    private const DB_HOST = "localhost";
    private const DB_NAME = "dwes_pedidos";
    private const DB_USER = "root";
    private const DB_PASS = "";
    private static $connection;

    /**
     * Devuelve la conexión a la bd
     *
     * @return mixed La conexión o bien un error en caso de fallo
     */
    private static function getConnection()
    {
        if (empty(self::$connection)) {
            try {
                self::$connection = new PDO("mysql:host=" . self::DB_HOST . ';dbname=' . self::DB_NAME, self::DB_USER, self::DB_PASS);
            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        }
        return self::$connection;
    }

    /**
     * Ejecuta la sentencia SQL contra la conexión db y sustituyendo las ? por los valores del array values
     *
     * @param PDO $db Conexión a la db
     * @param string $sql Sentencia SQL
     * @param array $values Array de valores que sustituyen las ? de la sentencia preparada
     * @return PDOStatement|string El objeto del resultado al ejecutar la sentencia SQL o un string con el error
     */
    public static function query($sql, $values)
    {
        $db = self::getConnection();
        try {
            if (false === strpos($sql, "INSERT")) {
                $db->beginTransaction();
            }
            $result = $db->prepare($sql);
            $result->execute($values);
            if ($result) {
                if ('' === "INSERT" || false !== strpos($sql, "INSERT")) {
                    return $db->lastInsertId();
                } else {
                    $db->commit();
                    return $result;
                }
            } else {
                if (false === strpos($sql, "INSERT")) {
                    $db->rollBack();
                }
                return $db->errorInfo();
            }
        } catch (PDOException $e) {
            return "Error al conectar con la db : " . $e->getMessage();
        }
    }

    /**
     * Inserta un restaurante
     *
     * @param [mixed] $values Valores a sustituir a los campos a insertar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function insertRestaurante($values)
    {
        $sql = "INSERT INTO RESTAURANTE (correo, clave, direccion, cp, pais) VALUES (?, ?, ?, ?, ?);";
        $values[1] = sha1($values[1]);
        return self::query($sql, $values);
    }

    /**
     * Inserta un pedido
     *
     * @param array $values Valores a sustituir a los campos a insertar
     * @return PDOStatement|string Consulta devuelta o mensaje de error
     */
    public static function insertPedido($values)
    {
        $sql = "INSERT INTO PEDIDO (fecha, enviado, cod_res_fk) VALUES (?, ?, ?);";
        return self::query($sql, $values);
    }

    /**
     * Inserta un pedidoproducto
     *
     * @param [mixed] $values Valores a sustituir a los campos a insertar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function insertPedidoProducto($values)
    {
        $sql = "INSERT INTO PEDIDOPRODUCTO (cod_ped, cod_prod, unidades) VALUES (?, ?, ?);";
        return self::query($sql, $values);
    }

    /**
     * Consulta un restaurante por id
     *
     * @param string $id
     * @param bool $isSha1 Si el id está hasheado
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getRestauranteById($id, $isSha1)
    {
        $sql = "SELECT * FROM RESTAURANTE WHERE " . ($isSha1 ? "sha1(cod_res)" : "cod_res") . " = ?;";
        return self::query($sql, [$id]);
    }

    /**
     * Consulta un restaurante por correo
     *
     * @param string $correo
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getRestauranteByCorreo($correo)
    {
        $sql = "SELECT * FROM RESTAURANTE WHERE correo = ?;";
        return self::query($sql, [$correo]);
    }

    /**
     * Consulta un restaurante por corre y clave
     *
     * @param string $correo
     * @param string $clave
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getRestauranteByCorreoYClave($correo, $clave)
    {
        $sql = "SELECT * FROM RESTAURANTE WHERE correo = ? AND clave = ?;";
        return self::query($sql, [$correo, sha1($clave)]);
    }

    /**
     * Consulta todos los restaurantes
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getTodosLosRestaurantes()
    {
        $sql = "SELECT * FROM RESTAURANTE ORDER BY cod_res;";
        return self::query($sql, []);
    }

    /**
     * Consulta varios restaurantes por ids
     *
     * @param array $ids
     * @param bool $isSha1 Si los ids están hasheados
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getRestaurantes($ids, $isSha1)
    {
        $pStatementIds = "";
        if (count($ids) > 0) {
            $pStatementIds = self::getPreparedStatementArguments($ids);
            $sql = "SELECT * FROM RESTAURANTE WHERE " . ($isSha1 ? "sha1(cod_res)" : "cod_res") . " in ($pStatementIds) ORDER BY cod_res;";
        } else {
            return self::getNingunProducto();
        }
        $idsTemp = [];
        foreach ($ids as $id) {
            $idTemp = $isSha1 ? sha1($id) : $id;
            array_push($idsTemp, $idTemp);
        }
        return self::query($sql, $idsTemp);
    }

    /**
     * Consulta categoria por id
     *
     * @param string $id
     * @param bool $isSha1 Si el id está hasheado
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getCategoria($id, $isSha1)
    {
        $sql = "SELECT * FROM CATEGORIA WHERE " . ($isSha1 ? "sha1(cod_cat)" : "cod_cat") . " = ?;";
        return self::query($sql, [$id]);
    }

    /**
     * Consulta todas las categorias
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getTodasLasCategorias()
    {
        $sql = "SELECT * FROM CATEGORIA ORDER BY cod_cat;";
        return self::query($sql, []);
    }

    /**
     * Consulta categorias por ids
     *
     * @param array $ids
     * @param bool $isSha1 Si los ids están hasheados
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getCategorias($ids, $isSha1)
    {
        $pStatementIds = "";
        if (count($ids) > 0) {
            $pStatementIds = self::getPreparedStatementArguments($ids);
            $sql = "SELECT * FROM CATEGORIA WHERE " . ($isSha1 ? "sha1(cod_cat)" : "cod_cat") . " in ($pStatementIds) ORDER BY cod_cat;";
        } else {
            return self::getNingunProducto();
        }
        return self::query($sql, $ids);
    }

    /**
     * Consulta productos por categoria
     *
     * @param string $idCategoria
     * @param bool $isSha1 Si el id está hasheado
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getProductosDeCategoria($idCategoria, $isSha1)
    {
        $sql = "SELECT *  FROM PRODUCTO WHERE " . ($isSha1 ? "sha1(cod_cat_fk)" : "cod_cat_fk") . " = ? ORDER BY cod_prod;";
        return self::query($sql, [$idCategoria]);
    }

    /**
     * Devuelve una consulta vacia
     *
     * @return PDOStatement Consulta vacia
     */
    public static function getNingunProducto()
    {
        $sql = "SELECT cod_prod FROM PRODUCTO WHERE p.cod_prod = -1;";
        return self::query($sql, []);
    }

    /**
     * Consulta un producto por id
     *
     * @param string $id
     * @param bool $isSha1 Si el id está hasheado
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getProducto($id, $isSha1)
    {
        $sql = "SELECT * FROM PRODUCTO WHERE " . ($isSha1 ? "sha1(cod_prod)" : "cod_prod") . " = ?;";
        return self::query($sql, [$id]);
    }

    /**
     * Consulta todos los productos
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getTodosLosProductos()
    {
        $sql = "SELECT * FROM PRODUCTO ORDER BY cod_prod;";
        return self::query($sql, []);
    }

    /**
     * Consulta productos por ids
     *
     * @param array $ids
     * @param bool $isSha1 Si los ids están hasheados
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getProductos($ids, $isSha1)
    {
        $pStatementIds = "";
        if (count($ids) > 0) {
            $pStatementIds = self::getPreparedStatementArguments($ids);
            $sql = "SELECT * FROM PRODUCTO WHERE " . ($isSha1 ? "sha1(cod_prod)" : "cod_prod") . " in ($pStatementIds) ORDER BY cod_prod;";
        } else {
            return self::getNingunProducto();
        }
        return self::query($sql, $ids);
    }

    /**
     * Actualiza clave a restaurante por id
     *
     * @param string $id
     * @param string $clave
     * @param bool $isSha1 Si el id está hasheado
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function updateClaveARestaurante($id, $clave, $isSha1)
    {
        $sql = "UPDATE RESTAURANTE SET clave = ? WHERE " . ($isSha1 ? "sha1(cod_res)" : "cod_res") . " = ?;";
        $id = $isSha1 ? sha1($id) : $id;
        return self::query($sql, [sha1($clave), $id]);
    }

    /**
     * Actualiza si el pedido esta enviado por id
     *
     * @param string $id
     * @param bool $enviado
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function updatePedidoEnviado($id, $enviado)
    {
        $sql = "UPDATE PEDIDO SET enviado = ? WHERE cod_ped = ?;";
        return self::query($sql, [$enviado, $id]);
    }

    /**
     * Prepara los valores para usarlos para crear una consulta SQL preparada
     *
     * @param array $values
     * @return string Parte de la sentencia SQL preparada con tantas interrogaciones como valores hay en values
     */
    private static function getPreparedStatementArguments($values)
    {
        return str_repeat('?,', count($values) - 1) . '?';
    }
}
