<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 7/30/2019
 * Time: 1:25 PM
 */
include($_SERVER['DOCUMENT_ROOT'] . "/mcs/chaincode/config.php");
include($_SERVER['DOCUMENT_ROOT'] . "/mcs/chaincode/curl.php");


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

function getUsers()
{
    $users = query(FABRIC_USER, new QueryArgs(USER_TABLE));
    $result = [];
    foreach ($users as $user) {
        $result[] = $user->value;
    }
    return $result;
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
            $q = getQualityInTask($uid, $task->value->id);
            $r = $task->value;
            if ($q) {
                $r->quality = $q->quality;
                $r->payment = $q->payment;
            }
            $results[] = $r;
        }
    }
    return $results;
}

function getQualityInTask($uid, $tid)
{
    $qts = query(FABRIC_SUBSCRIPTION, new QueryArgs(TASK_PARTICIPANTS_TABLE));
    foreach ($qts as $qt) {
        if ($qt->value->tid == $tid && $qt->value->uid == $uid) {
            return $qt->value;
        }
    }
    return false;
}

function getAvailableTasks($uid)
{
    $tasks = query(FABRIC_TASK, new QueryArgs(TASK_TABLE));
    $subs = getSubscribedTask($uid);
    $results = [];
    foreach ($tasks as $task) {
        if ($task->value->status == 'PENDING') {
            $subscribed = false;
            foreach ($subs as $sub) {
                if ($task->value->id == $sub->id) {
                    $subscribed = true;
                    break;
                }
            }
            if (!$subscribed) {
                $results[] = $task->value;
            }
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


function createTask($userId, $title, $minQuality, $budget, $expiryDate)
{
    return invoke(FABRIC_TASK, new InvokeArgs(TASK_TABLE, [
        'minQ' => $minQuality,
        'budget' => $budget,
        'expDt' => $expiryDate,
        'uid' => $userId,
        'title' => $title,
        'status' => 'PENDING',
        'isDeleted' => 0
    ]));
}

function createTaskpts($userId, $taskId, $quality, $payment)
{
    return invoke(FABRIC_SUBSCRIPTION, new InvokeArgs(TASK_PARTICIPANTS_TABLE, [
        'tid' => $taskId,
        'uid' => $userId,
        'quality' => $quality,
        'payment' => $payment,
        'isDeleted' => 0
    ]));
}

function subscribe($taskId, $userId)
{
    return invoke(FABRIC_SUBSCRIPTION, new InvokeArgs(SUBSCRIPTION_TABLE, [
        'tid' => $taskId,
        'uid' => $userId,
        'isDeleted' => 0
    ]));
}

function setReputation($userId, $reputation)
{
    return invoke(FABRIC_REPUTATION, new InvokeArgs(REPUTATION_TABLE, [
        'uid' => $userId,
        'reputation' => $reputation,
        'isDeleted' => 0
    ]));
}

function addObservation($userId, $taskId, $date, $record)
{
    foreach (getSubscribedTask($userId) as $task) {
        if ($task->id == $taskId) {
            return invoke(FABRIC_OBSERVATION, new InvokeArgs(OBSERVATION_TABLE, [
                'uid' => $userId,
                'tid' => $taskId,
                'date' => $date,
                'record' => json_encode($record),
                'isDeleted' => 0
            ]));
        }
    }
    return 'invalid task or user';
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

function getAllObservations()
{
    $observations = query(FABRIC_OBSERVATION, new QueryArgs(OBSERVATION_TABLE));
    $results = [];
    foreach ($observations as $observation) {
        $results [] = $observation->value;
    }
    return $results;
}

/**
 * @param $tid
 * @return \Curl\Curl|Exception
 */
function aggregate($tid)
{
    $results = execute(FABRIC_OBSERVATION, 'aggregate', [$tid], true);
    return $results;
}

/**
 * @param $tid
 */
function quality($tid)
{
    $results = execute(FABRIC_SUBSCRIPTION, 'quality', [$tid], true)->response[0];
    $results = json_decode($results);
    foreach ($results as $qlt) {
        $obj = json_decode($qlt);
        createTaskpts($obj->uid, $obj->tid, $obj->quality, $obj->payment);
    }
    return true;
}

function _list($path, $table)
{
    $records = query($path, new QueryArgs($table));
    $results = [];
    foreach ($records as $record) {
        $results[] = $record;
    }
    return $results;
}

function exists($table, $id)
{
    $result = null;
    switch ($table) {
        case 'user':
            $result = query(FABRIC_USER, new QueryArgs(USER_TABLE));
            break;
        case 'task':
            $result = query(FABRIC_TASK, new QueryArgs(TASK_TABLE));
            break;
    }
    if (!$result) return false;
    foreach ($result as $row) {
        if ($row->value->id == $id) {
            return true;
        }
    }
    return false;
}


function getReport($tid)
{
    $results = execute(FABRIC_REPORT, 'report', [$tid], true);
    $asJson = json_decode($results->response[0]) or "error";
    return $asJson;
}


