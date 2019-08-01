<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 8/1/2019
 * Time: 8:31 AM
 */

require __DIR__ . '/../vendor/autoload.php';

use \Curl\Curl;

/**
 * args = ["account", "4", "{name:foor}"]
 * @param array $path
 * @param InvokeArgs $args
 * @param bool $wait
 * @return bool|InvokeResult
 */
function invoke($path, $args, $wait = true)
{
    try {
        $path = new FabricPath($path);
        $curl = new Curl();
        $curl->setHeader('Authorization', "Bearer {$path->auth}");
        $curl->setHeader('Content-Type', 'application/json');
        $curl->post("http://localhost:{$path->port}/channels/{$path->channel}/chaincodes/{$path->chaincode}", array(
            'fcn' => 'put',
            'args' => $args->build(),
            'waitForTransactionEvent' => $wait,
        ));
        return new InvokeResult($curl->response, $args->getId());
    } catch (Exception $e) {
        return false;
    }
}

/**
 * @param array $path
 * @param QueryArgs $args
 * @return array
 */
function query($path, $args)
{
    try {
        $path = new FabricPath($path);
        $curl = new Curl();
        $curl->setHeader('Authorization', "Bearer {$path->auth}");
        $curl->setHeader('Content-Type', 'application/json');
        $curl->get("http://localhost:{$path->port}/channels/{$path->channel}/chaincodes/{$path->chaincode}", array(
            'fcn' => 'list',
            'args' => $args->build(),
            'unescape' => 'true',
        ));
        return $curl->response[0];
    } catch (Exception $e) {
        return null;
    }
}

function auth($port, $username, $password)
{
    try {
        $curl = new Curl();
        $curl->setHeader('Authorization', "Bearer {$path->auth}");
        $curl->setHeader('Content-Type', 'application/json');
        $curl->post("http://localhost:$port/users", array(
            'username' => $username,
            'password' => $password,
        ));
        return $curl->response;
    } catch (Exception $e) {
        return false;
    }
}

/**
 * @param array $path
 * @param DeleteArgs $args
 * @param bool $wait
 * @return bool|InvokeResult
 * @deprecated not working yet
 */
function delete($path, $args, $wait = true)
{
    try {
        $path = new FabricPath($path);
        $curl = new Curl();
        $curl->setHeader('Authorization', "Bearer {$path->auth}");
        $curl->setHeader('Content-Type', 'application/json');
        $curl->post("http://localhost:{$path->port}/channels/{$path->channel}/chaincodes/{$path->chaincode}", array(
            'fcn' => 'delete',
            'args' => $args->build(),
            'waitForTransactionEvent' => $wait,
        ));
        return new InvokeResult($curl->response, $args->id);
    } catch (Exception $e) {
        return false;
    }
}


class InvokeResult
{
    public $result;
    public $insertedId;

    public function __construct($result, $insertedId)
    {
        $this->result = $result;
        $this->insertedId = $insertedId;
    }

    public function isValid()
    {
        return $this->result && isset($this->result->status) && $this->result->status === "VALID";
    }

    public function getTransactionId()
    {
        if ($this->isValid()) {
            return $this->result->txid;
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getInsertedId()
    {
        return $this->insertedId;
    }
}

class InvokeArgs
{
    public $id;
    public $table;
    public $record;

    public function __construct($table, array $record, $id = null)
    {
        if ($id === null) $id = uniqid();

        $this->id = $id;
        $this->table = $table;
        $this->record = $record;
        $this->record['id'] = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $record
     */
    public function setRecord(array $record)
    {
        $this->record = $record;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    public function build()
    {
        return ["$this->table", "$this->id", json_encode($this->record)];
    }
}

class QueryArgs
{
    public $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    public function build()
    {
        return '["' . $this->table . '"]';
    }
}

class DeleteArgs
{
    public $table;
    public $id;

    public function __construct($table, $id)
    {
        $this->table = $table;
        $this->id = $id;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    public function build()
    {
        return ["$this->table", "$this->id"];
    }
}


class FabricPath
{
    public $port;
    public $channel;
    public $chaincode;
    public $auth;

    public function __construct($config)
    {
        $this->port = $config['port'];
        $this->chaincode = $config['chaincode'];
        $this->channel = $config['channel'];
        $this->auth = $config['auth'];
    }
}