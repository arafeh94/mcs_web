<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 8/1/2019
 * Time: 8:45 AM
 */

include "curl.php";

define("channel", "common");
define("chaincode", "reference");
define("auth", "");

print_r([
    "channel" => channel,
    "chaincode" => chaincode,
    "auth" => auth,
]);

echo "<br>";

echo "test invoke:";
$result = invoke(channel, chaincode, auth, new InvokeArgs('account', 1, ['name' => 'arafeh']));
var_dump($result);

echo "<br>";
echo "<br>";
echo "<br>";
echo "test query:<br>";
print_r(query(channel, chaincode, auth, new QueryArgs("account")));