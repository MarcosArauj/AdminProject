<?php

namespace App\config\DB;


class Sql{
    const HOSTNAME = "185.201.11.230";
    const USERNAME = "u655389713_marcos";
    const PASSWORD = "251723";
    const DBNAME = "u655389713_db_tcc";

//    const HOSTNAME = "localHost";
//    const USERNAME = "root";
//    const PASSWORD = "";
//    const DBNAME = "db_tcc";

    private $conn;

    public function __construct() {

        $this->conn = new \PDO(
            "mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME,
            Sql::USERNAME,
            Sql::PASSWORD
        );

    }

    private function setParams($statement, $parameters = array()) {

        foreach ($parameters as $key => $value) {

            $this->bindParam($statement, $key, $value);

        }

    }

    private function bindParam($statement, $key, $value) {

        $statement->bindParam($key, $value);

    }

    public function query($rawQuery, $params = array()) {

        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

    }

    public function select($rawQuery, $params = array()):array {

        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

}
