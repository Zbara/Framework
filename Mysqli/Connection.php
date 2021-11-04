<?php
namespace Zbara\Framework\Mysqli;

use mysqli;
use Zbara\Framework\Exception\ConfigException;

/**
 * Class Connection
 */
class Connection implements ManagerRegistry
{
    /** @var int  */
    CONST SQL_RESULT_ITEM = 1;
    CONST SQL_RESULT_ITEMS = 2;
    CONST SQL_RESULT_COUNT = 3;
    CONST SQL_RESULT_AFFECTED = 4;
    CONST SQL_RESULT_INSERTED = 5;

    /** @var array|mysqli  */
    public $mysqli = [];

    /**
     * Connection constructor.
     * @param $db_server
     * @param $db_user
     * @param $db_pass
     * @param $db_name
     */
    public function __construct($db_server, $db_user, $db_pass, $db_name)
    {
        $this->mysqli = new mysqli($db_server, $db_user, $db_pass, $db_name);
        try {
            if ($this->mysqli->connect_error) throw new ConfigException(Code::INTERNAL_DATABASE_ERROR, ['msg' => $this->mysqli->connect_error]);
        } catch (ConfigException $e){
            die(json_encode($e->jsonSerialize()));
        }
        $this->mysqli->set_charset("utf8mb4");
    }

    public function query($query, $resultType = self::SQL_RESULT_ITEM)
    {
        /** @var  $result */
        $result = $this->mysqli->query($query);

        try {
            if ($this->mysqli->error) {
                throw new ConfigException(Code::INTERNAL_DATABASE_ERROR_SQL, [
                    'sql' => $query,
                    'table' => $this->mysqli->error,
                    'errorno' => $this->mysqli->errno
                ]);
            }
        } catch (ConfigException $e){
            die(json_encode($e->jsonSerialize()));
        }
        /** если все нормально отдаем резузьтат */
        switch ($resultType) {
            case  self::SQL_RESULT_ITEM:
                return $result->fetch_object();

            case  self::SQL_RESULT_ITEMS:
                $data = [];
                while ($row = $result->fetch_object()) {
                    $data[] = $row;
                }
                return $data;

            case self:: SQL_RESULT_COUNT:
                return (int)$result->fetch_assoc()["COUNT(*)"];

            case  self::SQL_RESULT_INSERTED:
                return (int)$this->mysqli->insert_id;

            case  self::SQL_RESULT_AFFECTED:
                return (int)$this->mysqli->affected_rows;
        }
        return [];
    }

    /**
     * очистка строки
     * @param $string
     * @return string
     */
    public function escape($string): string
    {
        return $this->mysqli->escape_string($string);
    }

    /**
     * @param $string
     * @return string
     */
    public function real_escape_string($string): string
    {
        return $this->mysqli->real_escape_string($string);
    }

    /**
     * Закрытие коннекшена с БД
     */
    public function closeDatabase()
    {
        $this->mysqli->close();
    }
}