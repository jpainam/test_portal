<?php
namespace App;

use App\Database;
use App\Query;
use App\QueryFirebase;

class Entity {

    protected $requestType;

    protected $table;

    protected $institution = 'Institut Polyvalent WAGUE';

    protected $queryFirebase;

    protected $dbOffline;

    protected $pdo;

    protected $query;

    protected $data;

    protected $collection;

    public function __construct()
    {
        $this->queryFirebase = new QueryFirebase();
        $this->pdo = (new \Database())->getPdo();
        if (empty($this->table)) {
            $nameClass = explode('\\', get_called_class());
            $nameClass = end($nameClass);
            $nameClass = str_replace('Entity', '', $nameClass);
            $this->table = $nameClass;
        }
    }

    protected function makeQuery()
    {
        return (new Query())->from($this->table);
    }

    protected function hiddratation($data)
    {
        return [];
    }

    public function find($id)
    {
        $query = $this->makeQuery();
        $res = $this->pdo->prepare($query);
        $res->execute([$id]);
        if ($res) {
            $this->data = $this->hiddratation($res->fetch(\PDO::FETCH_ASSOC));
            return true;
        }
        $this->data = null;
        return false;
    }

    public function findAll()
    {
        $query = $this->makeQuery();
        $res = $this->pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        if ($res) {
            $this->data = $res;
            return true;
        }else {
            $this->data = null;
            return false;
        }
    }

    public function writeData()
    {
        $this->queryFirebase
            ->setCollection($this->collection)
            ->pushData($this->data)
            ->execute();
    }

}