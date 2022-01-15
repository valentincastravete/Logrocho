<?php

require_once "bd.php";

class CategoriaController
{

    /**
     * Muestra las categorias
     */
    public function index()
    {
        if (isLoggedIn()) {
            $categorias = bd::getTodasLasCategorias()->fetchAll(PDO::FETCH_ASSOC);
            require("view/categorias.php");
        }
    }

    /**
     * Muestra productos de una categoria
     *
     * @param string $id id de la categoria
     */
    public function showCategoria($id)
    {
        if (isLoggedIn()) {
            $categoria = bd::getCategoria($id, true);
            if (get_class($categoria) === "PDOStatement" && $categoria->rowCount() === 1) {
                $categoria = $categoria->fetch(PDO::FETCH_ASSOC);
                $productos = bd::getProductosDeCategoria(sha1($categoria['cod_cat']), true);
                require("view/productos.php");
            } else {
                $this->index();
            }
        }
    }
}
