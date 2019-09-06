<?php
define("SERVER_AUTH", "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJyb290IiwiaWF0IjoxNTY1MjU2MzEwfQ.pYTzSAH_yMgoVSsqoeFevoncOyUd5htzL8L1rxHhcDY");
define("WORKER_AUTH", "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJyb290IiwiaWF0IjoxNTY1MjU2MzEwfQ.pYTzSAH_yMgoVSsqoeFevoncOyUd5htzL8L1rxHhcDY");

define("FABRIC_USER", ["port" => "4000", "channel" => "users", "chaincode" => "ccusers", "auth" => SERVER_AUTH]);
define("FABRIC_TASK", ["port" => "4000", "channel" => "tasks", "chaincode" => "cctasks", "auth" => SERVER_AUTH]);
define("FABRIC_SUBSCRIPTION", ["port" => "4000", "channel" => "subscriptions", "chaincode" => "ccsubscriptions", "auth" => SERVER_AUTH]);
define("FABRIC_REPUTATION", ["port" => "4000", "channel" => "reputations", "chaincode" => "ccreputations", "auth" => SERVER_AUTH]);
define("FABRIC_OBSERVATION", ["port" => "4001", "channel" => "observations", "chaincode" => "ccobservations", "auth" => WORKER_AUTH]);
define("FABRIC_REPORT", ["port" => "4000", "channel" => "reports", "chaincode" => "ccreports", "auth" => SERVER_AUTH]);

define("USER_TABLE", "user");
define("TASK_TABLE", "task");
define("SUBSCRIPTION_TABLE", "subscription");
define("REPUTATION_TABLE", "reputation");
define("OBSERVATION_TABLE", "observation");
define("REPORT_TABLE", "report");

