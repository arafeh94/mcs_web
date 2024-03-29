<?php /** @noinspection ALL */

$local_auth_codes = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/mcs/chaincode/auth.json"));
define("SERVER_AUTH", $local_auth_codes->SERVER);
define("WORKER_AUTH", $local_auth_codes->WORKER);

define("FABRIC_USER", ["port" => "4000", "channel" => "users", "chaincode" => "ccusers", "auth" => SERVER_AUTH]);
define("FABRIC_TASK", ["port" => "4000", "channel" => "tasks", "chaincode" => "cctasks", "auth" => SERVER_AUTH]);
define("FABRIC_SUBSCRIPTION", ["port" => "4000", "channel" => "taskpts", "chaincode" => "cctaskpts", "auth" => SERVER_AUTH]);
define("FABRIC_REPUTATION", ["port" => "4000", "channel" => "reputations", "chaincode" => "ccreputations", "auth" => SERVER_AUTH]);
define("FABRIC_OBSERVATION", ["port" => "4000", "channel" => "observations", "chaincode" => "ccobservations", "auth" => SERVER_AUTH]);
define("FABRIC_REPORT", ["port" => "4000", "channel" => "reports", "chaincode" => "ccreports", "auth" => SERVER_AUTH]);

define("USER_TABLE", "user");
define("TASK_TABLE", "task");
define("TASK_PARTICIPANTS_TABLE", "taskpts");
define("SUBSCRIPTION_TABLE", "subscription");
define("REPUTATION_TABLE", "reputation");
define("OBSERVATION_TABLE", "observation");
define("REPORT_TABLE", "report");

