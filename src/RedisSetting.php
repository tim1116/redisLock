<?php
/**
 * File: RedisSeeting.php
 * PROJECT_NAME: redisLock
 */

namespace tim1116\redisLock;

/**
 * redis配置类
 * Class RedisSetting
 */
class RedisSetting
{
    public $host = '127.0.0.1';
    public $port = 6379;
    // 连接超时时间 默认3S
    public $timeout = 3.0;
    public $password = '';
    public $dbindex = 0;
    // 前缀
    public $prefix = 'redisLock:';

    public function __construct(Array $config = [])
    {
        $this->setConfig($config);
    }


    public function setConfig(Array $config)
    {
        if (isset($config['host'])) {
            $this->host = $config['host'];
        }

        if (isset($config['port'])) {
            $this->port = $config['port'];
        }

        if (isset($config['timeout'])) {
            $this->timeout = $config['timeout'];
        }

        if (isset($config['password'])) {
            $this->password = $config['password'];
        }

        if (isset($config['dbindex'])) {
            $this->dbindex = $config['dbindex'];
        }

        if (isset($config['prefix'])) {
            $this->prefix = $config['prefix'];
        }

    }
}