<?php

include($_SERVER['DOCUMENT_ROOT'] . "/mcs/chaincode/curl.php");


$server = auth(4000, "root", "root");
$worker = auth(4001, "root", "root");

$auth_json = [
    'SERVER' => $server,
    'WORKER' => $worker
];

$file = fopen($_SERVER['DOCUMENT_ROOT'] . "/mcs/chaincode/auth.json", "w");
print_r(error_get_last());
fwrite($file, json_encode($auth_json));
fclose($file);
echo "auth generated successfully";