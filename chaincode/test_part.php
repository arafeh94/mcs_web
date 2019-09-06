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


body_start();

//new_line("*********get all observations**********");
//new_line(addUser("ahmad", "ahmad@gmail.com", "123456", "p"));
//new_line(getUser("arafeh","123456"));
$ahmad = "5d6397d816e7d";
$arafeh = "5d6397d34f307";
$task = '5d6397dc5fa97';


new_line("***********get all available tasks************");
new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));

body_end();