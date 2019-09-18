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
$ahmad = "5d8027de5062c";
$arafeh = "5d8027d9cf47c";
$ajaj = "5d8027e2a1a49";
$task = '5d8027e6e6df3';


new_line("***********get all available tasks************");
//new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
//new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
//new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
//new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
//new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
//new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
//new_line(addObservation('5d6670312d91b', '5d666ad13d44d', "2019-10-10 12:00:02", ['lat' => 10, 'lng' => 12, 'activity' => 4]));
//$results = execute(FABRIC_SUBSCRIPTION, 'quality', ['5d8083bbda612'], true)->response[0];
//new_line(quality('5d80848aecdc2'));
new_line(getAllScores());

//$r = execute(["port" => "4000", "channel" => "common", "chaincode" => "reference", "auth" => SERVER_AUTH],'test',['ifconfig'],true)->response;
//new_line($r);

body_end();