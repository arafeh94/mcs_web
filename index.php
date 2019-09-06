<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
$page = isset($_GET['r']) ? $_GET['r'] : false;

if (!$page) {
    $page = 'login';
}


$page = $page . '.php';

include "template/header.php";
echo "<div id='content' style='margin-top: 16px'>";
if ((@include $page) === false) {
    include "error.php";
}
echo "</div>";
include "template/footer.php";

