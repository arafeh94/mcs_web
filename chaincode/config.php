<?php
define("SERVER_AUTH", "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJyb290IiwiaWF0IjoxNTY0NjU2MTM0fQ.wNv3rsImrM_0-LUeJXwjB6nJRAfUKDvpWS2-i3U5LPk");
define("WORKER_AUTH", "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJyb290IiwiaWF0IjoxNTY0NjU2MTM0fQ.wNv3rsImrM_0-LUeJXwjB6nJRAfUKDvpWS2-i3U5LPk");


define("FABRIC_USER", ["port" => "4000", "channel" => "common", "chaincode" => "reference", "auth" => SERVER_AUTH]);
define("FABRIC_TASK", ["port" => "4000", "channel" => "common", "chaincode" => "reference", "auth" => SERVER_AUTH]);
define("FABRIC_SUBSCRIPTION", ["port" => "4000", "channel" => "common", "chaincode" => "reference", "auth" => SERVER_AUTH]);
define("FABRIC_REPUTATION", ["port" => "4000", "channel" => "common", "chaincode" => "reference", "auth" => SERVER_AUTH]);
define("FABRIC_OBSERVATION", ["port" => "4000", "channel" => "common", "chaincode" => "reference", "auth" => SERVER_AUTH]);
define("FABRIC_REPORT", ["port" => "4000", "channel" => "common", "chaincode" => "reference", "auth" => SERVER_AUTH]);

define("USER_TABLE", "user");
define("TASK_TABLE", "task");
define("SUBSCRIPTION_TABLE", "subscription");
define("REPUTATION_TABLE", "reputation");
define("OBSERVATION_TABLE", "observation");
define("REPORT_TABLE", "report");

