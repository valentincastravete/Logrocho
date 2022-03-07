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
                self::$connection->exec("SET CHARACTER SET utf8");
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
        $sql = "SELECT * FROM usuario WHERE correo = ? AND clave = ?;";
        return self::query($sql, [$correo, sha1($clave)]);
    }

    /**
     * Consulta un usuario por corre y clave
     *
     * @param string $correo
     * @param string $clave
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getUsuarioByCorreo($correo)
    {
        $sql = "SELECT * FROM usuario WHERE correo = ?;";
        return self::query($sql, [$correo]);
    }

    /**
     * Consulta cantidad maxima de bares
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function maxBares()
    {
        $sql = "SELECT count(id) FROM bar;";
        return self::query($sql, []);
    }

    /**
     * Consulta varios bares
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getBares(int $index, int $cantidad, int $order_by, bool $asc_desc)
    {
        $sql = "SELECT column_name FROM information_schema.columns WHERE table_schema = 'logrocho' AND table_name = 'bar'";
        $result = self::query($sql, []);
        $nombreCampo = $result->fetchAll(PDO::FETCH_ASSOC)[$order_by]["column_name"];
        $sql = "SELECT * FROM bar ORDER BY $nombreCampo " . ($asc_desc ? "ASC" : "DESC") . " LIMIT $index, $cantidad;";
        return self::query($sql, []);
    }

    /**
     * Consulta varios bares por filtro
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getBaresFiltrados(int $index, int $cantidad, string $busqueda)
    {
        if (empty($busqueda)) {
            $sql = "SELECT * FROM bar LIMIT $index, $cantidad;";
        } else {
            $sql = "SELECT * FROM bar WHERE nombre LIKE '%$busqueda%' OR direccion LIKE '%$busqueda%' LIMIT $index, $cantidad;";
        }
        return self::query($sql, []);
    }

    /**
     * Consulta las rutas de las imagenes de un bar
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getImagenesBar(int $id_bar)
    {
        $sql = "SELECT ruta FROM imagen_bar WHERE id_bar = $id_bar";
        return self::query($sql, []);
    }

    /**
     * Consulta todos los bares y devuelve solo sus ids y nombres
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getTodosLosBares()
    {
        $sql = "SELECT id, nombre FROM bar ORDER BY nombre;";
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
        $sql = "SELECT * FROM bar WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
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
        $sql = "INSERT INTO bar (nombre, direccion, terraza, latitud, longitud) VALUES (?, ?, ?, ?, ?);";
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
        $sql = "DELETE FROM bar WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
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
        $sql = "UPDATE bar SET nombre=?, direccion=?, terraza=?, latitud=?, longitud=? WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, $values);
    }

    /**
     * Consulta cantidad maxima de pinchos
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function maxPinchos()
    {
        $sql = "SELECT count(id) FROM pincho;";
        return self::query($sql, []);
    }

    /**
     * Consulta todos los pinchos y devuelve solo sus ids y nombres
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getTodosLosPinchos()
    {
        $sql = "SELECT id, nombre FROM pincho ORDER BY nombre;";
        return self::query($sql, []);
    }

    /**
     * Consulta varios pinchos
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getPinchos(int $index, int $cantidad, int $order_by, bool $asc_desc)
    {
        $sql = "SELECT column_name FROM information_schema.columns WHERE table_schema = 'logrocho' AND table_name = 'pincho'";
        $result = self::query($sql, []);
        $nombreCampo = $result->fetchAll(PDO::FETCH_ASSOC)[$order_by]["column_name"];
        $sql = "SELECT * FROM pincho ORDER BY $nombreCampo " . ($asc_desc ? "ASC" : "DESC") . " LIMIT $index, $cantidad;";
        return self::query($sql, []);
    }

    /**
     * Consulta varios pinchos por filtro
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getPinchosFiltrados(int $index, int $cantidad, string $busqueda)
    {
        if (empty($busqueda)) {
            $sql = "SELECT * FROM pincho LIMIT $index, $cantidad;";
        } else {
            $sql = "SELECT pincho.id as id, pincho.nombre as nombre, pincho.descripcion as descripcion, pincho.id_bar as id_bar FROM pincho LEFT JOIN bar ON pincho.id_bar = bar.id WHERE pincho.nombre LIKE '%$busqueda%' OR bar.nombre LIKE '%$busqueda%' LIMIT $index, $cantidad;";
        }
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
        $sql = "SELECT * FROM pincho WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
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
        $sql = "INSERT INTO pincho (nombre, descripcion, id_bar) VALUES (?, ?, ?);";
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
        $sql = "DELETE FROM pincho WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
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
        $sql = "UPDATE pincho SET nombre=?, descripcion=?, id_bar=? WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, $values);
    }

    /**
     * Consulta cantidad maxima de usuarios
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function maxUsuarios()
    {
        $sql = "SELECT count(id) FROM usuario;";
        return self::query($sql, []);
    }

    /**
     * Consulta todos los usuarios y devuelve solo sus ids y nombres
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getTodosLosUsuarios()
    {
        $sql = "SELECT id, nombre FROM usuario ORDER BY nombre;";
        return self::query($sql, []);
    }

    /**
     * Consulta varios usuarios
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getUsuarios(int $index, int $cantidad, int $order_by, bool $asc_desc)
    {
        $sql = "SELECT column_name FROM information_schema.columns WHERE table_schema = 'logrocho' AND table_name = 'usuario'";
        $result = self::query($sql, []);
        $nombreCampo = $result->fetchAll(PDO::FETCH_ASSOC)[$order_by]["column_name"];
        $sql = "SELECT * FROM usuario ORDER BY $nombreCampo " . ($asc_desc ? "ASC" : "DESC") . " LIMIT $index, $cantidad;";
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
        $sql = "SELECT * FROM usuario WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
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
        $sql = "INSERT INTO usuario (nombre, correo, clave, admin, ruta_imagen) VALUES (?, ?, ?, ?, ?);";
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
        $sql = "DELETE FROM usuario WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ? AND 'admin' = FALSE;";
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
        $sql = "UPDATE usuario SET nombre=?, correo=?, admin=? WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, $values);
    }

    /**
     * Actualiza la imagen de perfil de un usuario
     *
     * @param [mixed] $values Valores a sustituir a los campos a actualizar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function setImg($values, $isSha1)
    {
        $sql = "UPDATE usuario SET ruta_imagen=? WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, $values);
    }

    /**
     * Consulta cantidad maxima de valoraciones
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function maxValoraciones()
    {
        $sql = "SELECT count(id) FROM valoracion;";
        return self::query($sql, []);
    }

    /**
     * Consulta varios valoraciones
     *
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function getValoraciones(int $index, int $cantidad, int $order_by, bool $asc_desc)
    {
        $sql = "SELECT column_name FROM information_schema.columns WHERE table_schema = 'logrocho' AND table_name = 'valoracion'";
        $result = self::query($sql, []);
        $nombreCampo = $result->fetchAll(PDO::FETCH_ASSOC)[$order_by]["column_name"];
        $sql = "SELECT * FROM valoracion ORDER BY $nombreCampo " . ($asc_desc ? "ASC" : "DESC") . " LIMIT $index, $cantidad;";
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
        $sql = "SELECT * FROM valoracion WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
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
        $sql = "INSERT INTO valoracion (id_usuario, id_pincho, descripcion, calificacion) VALUES (?, ?, ?, ?);";
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
        $sql = "DELETE FROM valoracion WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
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
        $sql = "DELETE valoracion FROM valoracion RIGHT JOIN usuario ON valoracion.id_usuario = usuario.id WHERE " . ($isUsuarioSha1 ? "sha1(usuario.id)" : "usuario.id") . " = ? AND " . ($isValoracionSha1 ? "sha1(valoracion.id)" : "valoracion.id") . " = ? AND usuario.admin = FALSE;";
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
        $sql = "UPDATE valoracion SET id_usuario=?, id_pincho=?, descripcion=?, calificacion=? WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
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
        $sql = "INSERT INTO me_gusta (id_usuario, id_valoracion) VALUES (?, ?);";
        return self::query($sql, $values);
    }

    /**
     * Elimina un me gusta
     *
     * @param int $id Id del me gusta a eliminar
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function eliminarMeGusta($id, $isSha1)
    {
        $sql = "DELETE FROM me_gusta WHERE " . ($isSha1 ? "sha1(id)" : "id") . " = ?;";
        return self::query($sql, [$id]);
    }

    /**
     * Elimina todos los me gustas de un usuario no administrador
     *
     * @param int $id Id del usuario del que eliminar sus me gustas
     * @return PDOStatement|String Consulta devuelta o mensaje de error
     */
    public static function eliminarMeGustasDeUsuario($id, $isSha1)
    {
        $sql = "DELETE me_gusta FROM me_gusta RIGHT JOIN usuario ON me_gusta.id_usuario = usuario.id WHERE " . ($isSha1 ? "sha1(me_gusta.id_usuario)" : "me_gusta.id_usuario") . " = ? AND usuario.admin = FALSE;";
        return self::query($sql, [$id]);
    }

}
