<?php

require_once "bd.php";
require_once "correo.php";

class CarritoController
{

    /**
     * Muestra el carrito
     */
    public function index()
    {
        if (isLoggedIn()) {
            $codigosProductos = array_keys($_SESSION['carrito']);
            $productos = bd::getNingunProducto();
            $productosArray = [];
            $codigosCategorias = [];
            if (count($codigosProductos) > 0) {
                $productos = bd::getProductos($codigosProductos, true);
            }
            if (get_class($productos) === "PDOStatement") {
                $productosArray = $productos->fetchAll(PDO::FETCH_ASSOC);
                foreach ($productosArray as $producto) {
                    if (!array_search($producto["cod_cat_fk"], $codigosCategorias)) {
                        array_push($codigosCategorias, $producto["cod_cat_fk"]);
                    }
                }
            } else {
                header("Location: " . getHome());
            }
            $categorias = bd::getCategorias($codigosCategorias, false);
            if (get_class($categorias) === "PDOStatement") {
                require("view/carrito.php");
            } else {
                header("Location: " . getHome());
            }
        }
    }

    /**
     * Anade un producto
     */
    public function anadirProducto()
    {
        if (isLoggedIn()) {
            if (isset($_POST['cod']) && isset($_POST['unidades'])) {
                if (intval($_POST['unidades']) > 0) {
                    $producto = bd::getProducto($_POST["cod"], true);
                    if (get_class($producto) === "PDOStatement") {
                        $existeProducto = $producto->rowCount() > 0;
                        if ($existeProducto) {
                            if (isset($_SESSION['carrito'][$_POST['cod']])) {
                                $_SESSION['carrito'][$_POST['cod']] += $_POST['unidades'];
                            } else {
                                $_SESSION['carrito'][$_POST['cod']] = $_POST['unidades'];
                            }
                        }
                    }
                }
            }
            header("Location: " . getHome() . "carrito");
        }
    }

    /**
     * Elimina un producto
     */
    public function eliminarProducto()
    {
        if (isLoggedIn()) {
            if (isset($_POST['cod']) && isset($_POST['unidades'])) {
                if (intval($_POST['unidades']) > 0) {
                    $cantidadDisponible = $_SESSION['carrito'][$_POST['cod']];
                    $cantidadAEliminar = $_POST['unidades'];
                    if ($cantidadDisponible <= $cantidadAEliminar) {
                        unset($_SESSION['carrito'][$_POST['cod']]);
                    } else {
                        $_SESSION['carrito'][$_POST['cod']] -= $cantidadAEliminar;
                    }
                }
            }
            header("Location: " . getHome() . "carrito");
        }
    }

    /**
     * Procesa un pedido para enviar un correo y meter pedido en bd
     */
    public function procesar_pedido()
    {
        if (isLoggedIn()) {
            $mensaje = "";

            if (count($_SESSION['carrito']) > 0) {
                $cod_res = bd::getRestauranteById($_SESSION['user'][0], true)->fetch(PDO::FETCH_ASSOC)['cod_res'];
                $pedido = [date("Y-m-d"), False, $cod_res];
                $cod_ped = bd::insertPedido($pedido);
                $pedidos = "<ul>";
                foreach ($_SESSION['carrito'] as $cod_prod => $unidades) {
                    $producto = bd::getProducto($cod_prod, true)->fetch(PDO::FETCH_ASSOC);
                    $nombreProd = $producto['nombre'];
                    $cod_prod = $producto['cod_prod'];
                    $pedidos .= "<li>$nombreProd - $unidades " . ($unidades > 1 ? "unidades" : "unidad") . "</li>";
                    $pedidoProducto = [$cod_ped, $cod_prod, $unidades];
                    bd::insertPedidoProducto($pedidoProducto);
                }
                $pedidos .= "</ul>";
                if (enviarMail(
                    "valenpeke2@gmail.com",
                    file_get_contents("composer"),
                    $_SESSION['user'][1],
                    "Pedido realizado",
                    "Pedido realizado correctamente.<br>" . $pedidos
                )) {
                    $_SESSION['carrito'] = [];
                    $mensaje = "Pedido realizado correctamente.";
                    bd::updatePedidoEnviado($cod_ped, True);
                } else {
                    $mensaje = "Error al enviar el correo de su pedido";
                }
            } else {
                header("Location: " . getHome() . "categorias");
            }
            require("view/procesar_pedido.php");
        }
    }
}
