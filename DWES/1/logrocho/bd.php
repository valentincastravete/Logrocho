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
}
