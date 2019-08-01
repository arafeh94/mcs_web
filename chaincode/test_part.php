<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 8/1/2019
 * Time: 8:45 AM
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);
require "./chaincode.php";
require "../tools.php";
$userId = "5d42c22a3774f";
$taskId = "5d42c22f0c577";


body_start();

    new_line("*********get all observations**********");
    new_line(getObservations("5d42c22a3774f", "5d42c22f0c577"));


body_end();