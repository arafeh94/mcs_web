<?php
include '../tools.php';
include '../chaincode/chaincode.php';

$uid = post('uid');
$tid = post('tid');
$record = post('record');

if ($uid && $tid && $record) {
    if (json_last_error()) {
        die(json_encode('wrong record format, must be json'));
    }
    die(json_encode(addObservation($uid, $tid, date('y-d-m h:i:s'), $record)));
} else {
    die(json_encode("missing parameters"));
}
