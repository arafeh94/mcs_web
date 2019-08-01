<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 7/30/2019
 * Time: 1:25 PM
 */
include "./curl.php";

function userExists($username)
{
    query("user","ccuser","",new QueryArgs("user"));
    return false;
}

function getUser($username, $password)
{
    return ['id' => 123, 'type' => 'c'];
}

function getTasks($uid)
{
    return [
        ['id' => 1, 'title' => 'samira', 'minQ' => 'A', 'budget' => 1000, 'status' => 'RUNNING']
    ];
}

function getSubscribedTask($uid)
{
    return [
        ['id' => 1, 'title' => 'samira', 'minQ' => 'A', 'budget' => 1000, 'status' => 'RUNNING']
    ];
}

function getAvailableTask($uid)
{
    return [
        ['id' => 1, 'title' => 'samira', 'minQ' => 'A', 'budget' => 1000, 'status' => 'RUNNING']
    ];
}

function addUser($name, $email, $password, $type)
{

}


function createTask($userId, $minQuality, $budget, $expiryDate)
{

}

function addSubscription($taskId, $userId)
{

}

function setReputation($userId, $reputation)
{

}

function addObservation($userId, $taskId, $date, $record)
{

}

function addReport($taskId)
{

}

function getReport($taskId)
{

}


