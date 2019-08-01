<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 7/30/2019
 * Time: 1:25 PM
 */
include "./config.php";
include "./curl.php";

function userExists($username)
{
    $users = query(FABRIC_USER, new QueryArgs(USER_TABLE));
    foreach ($users as $user) {
        if ($user->value->username == $username) {
            return true;
        }
    }
    return false;
}

function getUser($username, $password)
{
    $users = query(FABRIC_USER, new QueryArgs(USER_TABLE));
    foreach ($users as $user) {
        if ($user->value->username == $username && $user->value->password == $password) {
            return $user->value;
        }
    }
    return false;
}

function getTasks($uid)
{
    $tasks = query(FABRIC_TASK, new QueryArgs(TASK_TABLE));
    $results = [];
    foreach ($tasks as $task) {
        if ($task->value->uid == $uid) {
            $results [] = $task->value;
        }
    }
    return $results;
}

function getSubscribedTask($uid)
{
    $tasks = query(FABRIC_TASK, new QueryArgs(TASK_TABLE));
    $subs = query(FABRIC_SUBSCRIPTION, new QueryArgs(SUBSCRIPTION_TABLE));
    $results = [];
    $reqTasksIds = [];
    foreach ($subs as $sub) {
        if ($sub->value->uid == $uid) {
            $reqTasksIds[] = $sub->value->tid;
        }
    }
    foreach ($tasks as $task) {
        if (in_array($task->value->id, $reqTasksIds)) {
            $results[] = $task->value;
        }
    }
    return $results;
}

function getAvailableTasks($uid)
{
    $tasks = query(FABRIC_TASK, new QueryArgs(TASK_TABLE));
    $results = [];
    foreach ($tasks as $task) {
        if ($task->value->status == 'PENDING') {
            $results[] = $task->value;
        }
    }
    return $results;
}

function addUser($name, $email, $password, $type)
{
    $result = invoke(FABRIC_USER, new InvokeArgs(USER_TABLE, [
        'username' => $name,
        'email' => $email,
        'password' => $password,
        'type' => $type,
        'isDeleted' => 0
    ]));
    if ($result->isValid()) {
        setReputation($result->insertedId, 0);
    }
    return $result;
}


function createTask($userId, $minQuality, $budget, $expiryDate)
{
    return invoke(FABRIC_TASK, new InvokeArgs(TASK_TABLE, [
        'minQ' => $minQuality,
        'budget' => $budget,
        'expDt' => $expiryDate,
        'uid' => $userId,
        'status' => 'PENDING',
        'isDeleted' => 0
    ]));
}

function subscribe($taskId, $userId)
{
    return invoke(FABRIC_SUBSCRIPTION, new InvokeArgs(SUBSCRIPTION_TABLE, [
        'tid' => $taskId,
        'uid' => $userId,
        'quality' => 0,
        'payment' => 0,
        'isDeleted' => 0
    ]));
}

function setReputation($userId, $reputation)
{
    return invoke(FABRIC_SUBSCRIPTION, new InvokeArgs(REPUTATION_TABLE, [
        'uid' => $userId,
        'reputation' => $reputation,
        'isDeleted' => 0
    ]));
}

function addObservation($userId, $taskId, $date, $record)
{
    return invoke(FABRIC_OBSERVATION, new InvokeArgs(OBSERVATION_TABLE, [
        'uid' => $userId,
        'tid' => $taskId,
        'date' => $date,
        'record' => json_encode($record),
        'isDeleted' => 0
    ]));
}

function getObservations($userId, $taskId)
{
    $observations = query(FABRIC_OBSERVATION, new QueryArgs(OBSERVATION_TABLE));
    $results = [];
    foreach ($observations as $observation) {
        if ($observation->value->tid == $taskId && $observation->value->uid == $userId) {
            $results [] = $observation->value;
        }
    }
    return $results;
}


function addReport($taskId)
{

}

function getReport($taskId)
{

}


