<?php

namespace Zbara\Framework\Config;



use Zbara\Framework\Exception\Code;
use Zbara\Framework\Exception\ConfigException;

class ConfigData
{
    private $host;
    private $db_user;
    private $db_name;
    private $db_pass;
    private $server;
    private $version;
    private $production;
    private $count_msg;
    private $parse_cnt;
    private $free_kassa_id;
    private $free_kassa_key;
    private $dev;
    private $proxy;
    private $application;
    private $stickers;
    private $botPath;
    private $access_token;


    public function __construct($config)
    {
        try {
            /**  */
            if (!is_readable(root . '/inc/config.php')) {
                throw new ConfigException(Code::CONFIG_ERROR, ['msg' => 'Файл не найден.']);
            }
            /**
             * @var  $k
             * @var  $item
             */
            foreach ($config as $k => $item) {
                $this->{$k} = $item;
            }
        } catch (ConfigException  $e) {
            die(json_encode($e->jsonSerialize()));
        }

    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host): void
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getDbUser()
    {
        return $this->db_user;
    }

    /**
     * @param mixed $db_user
     */
    public function setDbUser($db_user): void
    {
        $this->db_user = $db_user;
    }

    /**
     * @return mixed
     */
    public function getDbName()
    {
        return $this->db_name;
    }

    /**
     * @param mixed $db_name
     */
    public function setDbName($db_name): void
    {
        $this->db_name = $db_name;
    }

    /**
     * @return mixed
     */
    public function getDbPass()
    {
        return $this->db_pass;
    }

    /**
     * @param mixed $db_pass
     */
    public function setDbPass($db_pass): void
    {
        $this->db_pass = $db_pass;
    }

    /**
     * @return mixed
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param mixed $server
     */
    public function setServer($server): void
    {
        $this->server = $server;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version): void
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getProduction()
    {
        return $this->production;
    }

    /**
     * @param mixed $production
     */
    public function setProduction($production): void
    {
        $this->production = $production;
    }

    /**
     * @return mixed
     */
    public function getCountMsg()
    {
        return $this->count_msg;
    }

    /**
     * @param mixed $count_msg
     */
    public function setCountMsg($count_msg): void
    {
        $this->count_msg = $count_msg;
    }

    /**
     * @return mixed
     */
    public function getParseCnt()
    {
        return $this->parse_cnt;
    }

    /**
     * @param mixed $parse_cnt
     */
    public function setParseCnt($parse_cnt): void
    {
        $this->parse_cnt = $parse_cnt;
    }

    /**
     * @return mixed
     */
    public function getFreeKassaId()
    {
        return $this->free_kassa_id;
    }

    /**
     * @param mixed $free_kassa_id
     */
    public function setFreeKassaId($free_kassa_id): void
    {
        $this->free_kassa_id = $free_kassa_id;
    }

    /**
     * @return mixed
     */
    public function getFreeKassaKey()
    {
        return $this->free_kassa_key;
    }

    /**
     * @param mixed $free_kassa_key
     */
    public function setFreeKassaKey($free_kassa_key): void
    {
        $this->free_kassa_key = $free_kassa_key;
    }

    /**
     * @return mixed
     */
    public function getDev()
    {
        return $this->dev;
    }

    /**
     * @param mixed $dev
     */
    public function setDev($dev): void
    {
        $this->dev = $dev;
    }

    /**
     * @return mixed
     */
    public function getProxy()
    {
        return $this->proxy;
    }

    /**
     * @param mixed $proxy
     */
    public function setProxy($proxy): void
    {
        $this->proxy = $proxy;
    }

    /**
     * @return mixed
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param mixed $application
     */
    public function setApplication($application): void
    {
        $this->application = $application;
    }

    /**
     * @return mixed
     */
    public function getStickers()
    {
        return $this->stickers;
    }

    /**
     * @param mixed $stickers
     */
    public function setStickers($stickers): void
    {
        $this->stickers = $stickers;
    }

    /**
     * @return mixed
     */
    public function getBotPath()
    {
        return $this->botPath;
    }

    /**
     * @param mixed $botPath
     */
    public function setBotPath($botPath): void
    {
        $this->botPath = $botPath;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @param mixed $access_token
     */
    public function setAccessToken($access_token): void
    {
        $this->access_token = $access_token;
    }
}
