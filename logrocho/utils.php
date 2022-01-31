<?php

/**
 * Redirects the user to login.php page with the parameter logged_in to false
 *
 * @return void
 */
function isLoggedIn()
{
    return isset($_SESSION["user"]);
}

/**
 * Comprueba si la sesion esta iniciado como administrador
 *
 * @return void
 */
function isAdminLoggedIn()
{
    return (isset($_SESSION["user"]) && $_SESSION["user"][2]);
}

/**
 * Redirigue a la home dependiendo del tipo de usuario que ha iniciado sesion
 */
function redirectRespectiveHome() {
    if (isLoggedIn()) {
        if (isAdminLoggedIn()) {
            header("Location: " . getHome() . "bares");
        } else {
            header("Location: " . getHome() . "home");
        }
    } else {
        header("Location: " . getHome() . "login");
    }
}

/**
 * Returns the string value of the home path
 *
 * @return string
 */
function getHome()
{
    return explode("index.php", $_SERVER["REQUEST_URI"])[0] . "index.php/";
}

/**
 * Returns the string value of the absolute path including the protocol and host
 *
 * @return string
 */
function getAbsolutePath()
{
    return getProtocol() . $_SERVER["HTTP_HOST"] . getHome();
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
    return str_replace(getHome(), "", explode("?", $_SERVER["REQUEST_URI"])[0]);
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
