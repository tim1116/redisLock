<?php

/*
 * This file is part of the redisLock package.
 *
 * Author:Tim Xiao
 */

require __DIR__ . '/../vendor/autoload.php';

use tim1116\redisLock\RedisLock;
use tim1116\redisLock\RedisSetting;

$config = [
    'host'     => '192.168.199.101',
    'port'     => 6379,
    'password' => '123456',
    'dbindex'  => 6,
];
$obj    = RedisLock::getInstance(new RedisSetting($config));
$isLock = $obj->lock('aaa', 100);
var_dump($isLock);
