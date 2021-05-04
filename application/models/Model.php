<?php
namespace application\models;

use \PDO;

class Model
{
    public $pdo;

    public function __construct()
    {
        $dsn = _DBTYPE . ':host=' ._HOST. ';dbname=' . _DBNAME . ';charset=' . _CHARSET;

        try{
            $this->pdo = new PDO($dsn, _DBUSER, _DBPASSWORD);

            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (Execution $e) {
            var_dump("DB접속중 에러가 발생 하였습니다. : ". $e->getMessage());

        }
    }
}
