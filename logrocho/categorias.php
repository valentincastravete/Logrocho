<?php
session_start();
require_once "bd.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user'])) {
    echo false;
    die;
}
$result = bd::getTodasLasCategorias();
$categories = $result->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < count($categories); $i++) {
    $categories[$i]["cod_cat"] = sha1($categories[$i]["cod_cat"]);
}
echo json_encode($categories);
