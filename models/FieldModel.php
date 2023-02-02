<?php

require_once __DIR__ . "/../util/Database.php";
require_once __DIR__ . "/../entities/Field.php";


class FieldModel
{

    private ?mysqli $dbConn;

    public function __construct()
    {
        $this->dbConn = Database::getConnection();
    }

    /**
     * @return array|Field
     */
    public function getFields()
    {
        $selectSql = "SELECT * FROM Fields;";
        $result = $this->dbConn->query($selectSql);
        if ($result->num_rows > 0) {
            $fields = [];
            while ($row = $result->fetch_assoc()) {
                $fields[] = (new Field($row['id'], $row['name']))
                    ->toAssoc();
            }
            return $fields;
        }
        return new Field();
    }

    /**
     * @param $getFieldId
     * @return array|void
     */
    public function getField($getFieldId)
    {
        $selectSql = "SELECT * FROM Fields WHERE id = '" . $getFieldId . "'";
        $result = $this->dbConn->query($selectSql);

        if ($result->num_rows == 1 ) {
            $row = $result->fetch_assoc();
            return (new Field($row['id'], $row['name']))
                ->toAssoc();
        }
    }
}