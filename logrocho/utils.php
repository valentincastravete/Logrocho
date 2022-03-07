<?php

/**
 * @author Valentin Castravete <valentincastravete@gmail.com>
 */

/**
 * Comprueba si la sesion esta iniciada por un usuario
 *
 * @return bool Si el usuario esta registrado
 */
function isLoggedIn()
{
    return isset($_SESSION["user"]);
}

/**
 * Comprueba si la sesion esta iniciado como administrador
 *
 * @return bool Si el usuario esta registrado y es administrador
 */
function isAdminLoggedIn()
{
    return (isset($_SESSION["user"]) && $_SESSION["user"][2]);
}

/**
 * Redirigue a la home dependiendo del tipo de usuario que ha iniciado sesion
 */
function redirectRespectiveHome() {
    if (isAdminLoggedIn()) {
        header("Location: " . getIndex() . "bares");
    }
    header("Location: " . getIndex());
}

/**
 * Returns the string value of the index path
 *
 * @return string
 */
function getIndex()
{
    return getHome() . "index.php/";
}

/**
 * Returns the string value of the home path
 *
 * @return string
 */
function getHome()
{
    return explode("index.php", $_SERVER["REQUEST_URI"])[0];
}

/**
 * Returns the string value of the absolute path including the protocol and host
 *
 * @return string
 */
function getAbsolutePath()
{
    return getProtocol() . $_SERVER["HTTP_HOST"] . getIndex();
}

/**
 * Returns the string value of the server protocol
 *
 * @return string
 */
function getProtocol()
{
    return strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, strpos($_SERVER["SERVER_PROTOCOL"], "/"))) . "://";
}

/**
 * Returns a string of the request uri excluding the home path
 *
 * @return string
 */
function getArgumentsPath()
{
    return str_replace(getIndex(), "", explode("?", $_SERVER["REQUEST_URI"])[0]);
}

/**
 * Returns an array with the arguments from the request uri
 *
 * @return array
 */
function getArguments()
{
    return array_filter(explode("/", getArgumentsPath()));
}
