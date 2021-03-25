<?php

/*
 * This file is part of the redisLock package.
 *
 * Author:Tim Xiao
 */

namespace tim1116\redisLock;

use tim1116\redisLock\traits\Single;

class RedisLock
{
    use Single;

    private $redisSetting;

    private function __construct(RedisSetting $setting)
    {
        if (!extension_loaded('redis')) {
            throw new Exception('not support: redis'); //判断是否有扩展
        }
        $this->redisSetting = $setting;
    }

    public function lock(string $key, int $expire)
    {
        if (!$this->checkKey($key)) {
            throw new \InvalidArgumentException('key error,unexpected empty');
        }
        if ($expire <= 0) {
            throw new \InvalidArgumentException('expire time error');
        }
        $redis    = $this->connect();
        $key      = Util::lockKey($key);
        $timeout  = time() + $expire + 1;
        $isLocked = $redis->set($key, $timeout, ['nx', 'ex' => $expire]);
        if (!$isLocked) {
            return false;
        }

        return true;
    }

    // unlock
    public function unLock(string $key)
    {
        if (!$this->checkKey($key)) {
            throw new \InvalidArgumentException('key error,unexpected empty');
        }
        $redis = $this->connect();

        return $redis->del(Util::lockKey($key));
    }

    /**
     * 连接redis.
     *
     * @throws \RedisException
     */
    public function connect(): \Redis
    {
        $redis = new \Redis();
        $redis->connect($this->redisSetting->host, $this->redisSetting->port, $this->redisSetting->timeout);
        if ($this->redisSetting->password) {
            $redis->auth($this->redisSetting->password);
        }
        $redis->select($this->redisSetting->dbindex);
        if ($this->redisSetting->prefix) {
            $redis->setOption(\Redis::OPT_PREFIX, $this->redisSetting->prefix);
        }

        return $redis;
    }

    private function checkKey(string $key): bool
    {
        if (empty($key)) {
            return false;
        }

        return true;
    }
}
