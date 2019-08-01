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
 * @param $channel
 * @param $chaincode
 * @param $auth
 * @param InvokeArgs $args
 * @param bool $wait
 * @return bool
 */
function invoke($channel, $chaincode, $auth, $args, $wait = true)
{
    try {
        $curl = new Curl();
        $curl->setHeader('Authorization', "Bearer $auth");
        $curl->setHeader('Content-Type', 'application/json');
        $curl->post("http://localhost:4000/channels/$channel/chaincodes/$chaincode", array(
            'fcn' => 'put',
            'args' => $args->build(),
            'waitForTransactionEvent' => $wait,
        ));
        return true;
    } catch (Exception $e) {
        return false;
    }
}

/**
 * @param $channel
 * @param $chaincode
 * @param $auth
 * @param QueryArgs $args
 * @return array
 */
function query($channel, $chaincode, $auth, $args)
{
    try {
        $curl = new Curl();
        $curl->setHeader('Authorization', "Bearer $auth");
        $curl->setHeader('Content-Type', 'application/json');
        $curl->get("http://localhost:4000/channels/$channel/chaincodes/$chaincode", array(
            'fcn' => 'list',
            'args' => $args->build(),
            'unescape' => 'true',
        ));
        return $curl->response[0];
    } catch (Exception $e) {
        return [];
    }
}


class InvokeArgs
{
    public $id;
    public $table;
    public $record;

    public function __construct($table, $id, array $record)
    {
        $this->table = $table;
        $this->id = $id;
        $this->record = $record;
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
    public function setRecord($record)
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
        return [
            $this->table, $this->id, json_encode($this->record)
        ];
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