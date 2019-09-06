<div style="background-color: black;margin: 0">
<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 8/1/2019
 * Time: 8:45 AM
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);
include "chaincode.php";
include "../tools.php";


new_line(_list(FABRIC_TASK, TASK_TABLE));
new_line(_list(FABRIC_SUBSCRIPTION, TASK_PARTICIPANTS_TABLE));
new_line(_list(FABRIC_SUBSCRIPTION, SUBSCRIPTION_TABLE));