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

if (!isset($_POST['uid']) || !isset($_POST['tid'])) {
    form();
} else {
    body_start();
    clear();
    $uid = $_POST['uid'];
    $tid = $_POST['tid'];
    new_line("***********inserted observations************");
    new_line(addObservation($uid, $tid, "2019-10-10 12:00:22", record()));
    new_line(addObservation($uid, $tid, "2019-10-10 12:00:23", record()));
    new_line(addObservation($uid, $tid, "2019-10-10 12:00:24", record()));
    new_line(addObservation($uid, $tid, "2019-10-10 12:00:25", record()));
    new_line(addObservation($uid, $tid, "2019-10-10 12:00:26", record()));
    new_line(addObservation($uid, $tid, "2019-10-10 12:00:34", record()));
    new_line(addObservation($uid, $tid, "2019-10-10 12:00:35", record()));
    new_line(addObservation($uid, $tid, "2019-10-10 12:00:36", record()));
    new_line(addObservation($uid, $tid, "2019-10-10 12:00:37", record()));
    new_line(addObservation($uid, $tid, "2019-10-10 12:00:38", record()));
    body_end();
}


function record()
{
    $r = ['lat' => 10, 'lng' => 12, 'activity' => rand(1, 7)];
    new_line($r);
    return $r;
}


function clear(){
    echo <<<html
<form method="post"><input type="submit" value="clear"></form>
html;

}

function form()
{
    echo <<<html
<h3>Observation Generator</h3>
<form method="post">
User Id: <input type="text" name="uid" style="width: 180px"><br>
Task Id: <input type="text" name="tid" style="width: 180px"><br>
<input type="submit">
</form>
html;

}