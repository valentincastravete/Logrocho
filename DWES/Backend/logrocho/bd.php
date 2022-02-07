<?php
if (session_status() === PHP_SESSION_NONE) {
    header("Location: " . getHome());
    die;
}

class bd
{
    private const DB_HOST = "localhost";
    private const DB_NAME = "logrocho";
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
     * Consulta un usuario por corre y clave
     *
     * @param string $correo
     * @param string $clave
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getUsuarioByCorreoYClave($correo, $clave)
    {
        $sql = "SELECT * FROM USUARIO WHERE correo = ? AND clave = ?;";
        return self::query($sql, [$correo, sha1($clave)]);
    }

    /**
     * Consulta varios bares
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getBares(int $index, int $cantidad)
    {
        $sql = "SELECT * FROM BAR ORDER BY id LIMIT $index, $cantidad;";
        return self::query($sql, []);
    }

    /**
     * Consulta bar por id
     *
     * @param string $id
     * @param bool $isSha1 Si el id está hasheado
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getBar($id, $isSha1)
    {
        $sql = "SELECT * FROM BAR WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, [$id]);
    }

    /**
     * Inserta un bar
     *
     * @param [mixed] $values Valores a sustituir a los campos a insertar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function insertBar($values)
    {
        $sql = "INSERT INTO BAR (nombre, direccion, terraza, latitud, longitud) VALUES (?, ?, ?, ?, ?);";
        return self::query($sql, $values);
    }

    /**
     * Elimina un bar
     *
     * @param int $id Id del bar a eliminar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function eliminarBar($id, $isSha1)
    {
        $sql = "DELETE FROM BAR WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, [$id]);
    }

    /**
     * Actualiza un bar
     *
     * @param [mixed] $values Valores a sustituir a los campos a actualizar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function updateBar($values, $isSha1)
    {
        $sql = "UPDATE BAR SET nombre=?, direccion=?, terraza=?, latitud=?, longitud=? WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, $values);
    }

    /**
     * Consulta varios pinchos
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getPinchos(int $index, int $cantidad)
    {
        $sql = "SELECT * FROM PINCHO ORDER BY id LIMIT $index, $cantidad;";
        return self::query($sql, []);
    }

    /**
     * Consulta pincho por id
     *
     * @param string $id
     * @param bool $isSha1 Si el id está hasheado
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getPincho($id, $isSha1)
    {
        $sql = "SELECT * FROM PINCHO WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, [$id]);
    }

    /**
     * Inserta un pincho
     *
     * @param [mixed] $values Valores a sustituir a los campos a insertar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function insertPincho($values)
    {
        $sql = "INSERT INTO PINCHO (nombre, descripcion, id_bar) VALUES (?, ?, ?);";
        return self::query($sql, $values);
    }

    /**
     * Elimina un pincho
     *
     * @param int $id Id del pincho a eliminar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function elimnarPincho($id, $isSha1)
    {
        $sql = "DELETE FROM PINCHO WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, [$id]);
    }

    /**
     * Actualiza un pincho
     *
     * @param [mixed] $values Valores a sustituir a los campos a actualizar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function updatePincho($values, $isSha1)
    {
        $sql = "UPDATE PINCHO SET nombre=?, descripcion=?, id_bar=? WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, $values);
    }

    /**
     * Consulta varios usuarios
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getUsuarios(int $index, int $cantidad)
    {
        $sql = "SELECT * FROM USUARIO ORDER BY id LIMIT $index, $cantidad;";
        return self::query($sql, []);
    }

    /**
     * Consulta usuario por id
     *
     * @param string $id
     * @param bool $isSha1 Si el id está hasheado
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getUsuario($id, $isSha1)
    {
        $sql = "SELECT * FROM USUARIO WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, [$id]);
    }

    /**
     * Inserta un usuario
     *
     * @param [mixed] $values Valores a sustituir a los campos a insertar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function insertUsuario($values)
    {
        $sql = "INSERT INTO USUARIO (nombre, correo, clave, admin, ruta_imagen) VALUES (?, ?, ?, ?, ?);";
        $values[2] = sha1($values[2]);
        return self::query($sql, $values);
    }

    /**
     * Elimina un usuario si no es administrador
     *
     * @param int $id Id del usuario a eliminar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function eliminarUsuario($id, $isSha1)
    {
        $sql = "DELETE FROM USUARIO WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ? AND 'admin' = FALSE;";
        return self::query($sql, [$id]);
    }

    /**
     * Actualiza un usuario
     *
     * @param [mixed] $values Valores a sustituir a los campos a actualizar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function updateUsuario($values, $isSha1)
    {
        $sql = "UPDATE USUARIO SET nombre=?, correo=?, clave=?, admin=?, ruta_imagen=? WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        $values[2] = sha1($values[2]);
        return self::query($sql, $values);
    }

    /**
     * Consulta varias valoraciones
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getValoraciones(int $index, int $cantidad)
    {
        $sql = "SELECT * FROM VALORACION ORDER BY id LIMIT $index, $cantidad;";
        return self::query($sql, []);
    }

    /**
     * Consulta valoracion por id
     *
     * @param string $id
     * @param bool $isSha1 Si el id está hasheado
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getValoracion($id, $isSha1)
    {
        $sql = "SELECT * FROM VALORACION WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, [$id]);
    }

    /**
     * Inserta una valoracion
     *
     * @param [mixed] $values Valores a sustituir a los campos a insertar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function insertValoracion($values)
    {
        $sql = "INSERT INTO VALORACION (id_usuario, id_pincho, descripcion, calificacion) VALUES (?, ?, ?, ?);";
        return self::query($sql, $values);
    }

    /**
     * Elimina una valoracion
     *
     * @param int $id Id de la valoración a eliminar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function eliminarValoracion($id, $isSha1)
    {
        $sql = "DELETE FROM VALORACION WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, [$id]);
    }

    /**
     * Elimina una valoracion de un usuario no administrador
     *
     * @param int $id Id de la valoración a eliminar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function eliminarValoracionDeUsuario($idUsuario, $idValoracion, $isUsuarioSha1, $isValoracionSha1)
    {
        $sql = "DELETE FROM VALORACION as v RIGHT JOIN USUARIO as u ON v.id_usuario = u.id WHERE " . ($isUsuarioSha1 ? "sha1(v.id_usuario)" : "v.id_usuario") . " = ? AND " . ($isValoracionSha1 ? "sha1(v.id)" : "v.id") . " = ? AND u.admin = FALSE;";
        return self::query($sql, [$idUsuario, $idValoracion]);
    }

    /**
     * Actualiza una valoracion
     *
     * @param [mixed] $values Valores a sustituir a los campos a actualizar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function updateValoracion($values, $isSha1)
    {
        $sql = "UPDATE VALORACION SET id_usuario=?, id_pincho=?, descripcion=?, calificacion=? WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, $values);
    }

    /**
     * Inserta un me gusta
     *
     * @param [mixed] $values Valores a sustituir a los campos a insertar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function insertMeGusta($values)
    {
        $sql = "INSERT INTO VALORACION (id_usuario, id_valoracion) VALUES (?, ?);";
        return self::query($sql, $values);
    }

    /**
     * Elimina todos los me gustas de un usuario no administrador
     *
     * @param int $id Id de la valoración a eliminar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function eliminarMeGustasDeUsuario($id, $isSha1)
    {
        $sql = "DELETE FROM ME_GUSTA as m RIGHT JOIN USUARIO as u ON m.id_usuario = u.id WHERE " . ($isSha1 ? "sha1(m.id_usuario)" : "m.id_usuario") . " = ? AND u.admin = FALSE;";
        return self::query($sql, [$id]);
    }

}
