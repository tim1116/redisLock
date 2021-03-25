<?php

/*
 * This file is part of the redisLock package.
 *
 * Author:Tim Xiao
 */

require __DIR__ . '/../vendor/autoload.php';

use Swoole\Process;
use tim1116\redisLock\RedisLock;
use tim1116\redisLock\RedisSetting;

$config = [
    'host'     => '192.168.199.101',
    'port'     => 6379,
    'password' => '123456',
    'dbindex'  => 6,
];

$key = 'process';

// 多进程抢占锁资源
for ($n = 1; $n <= 5; ++$n) {
    $process = new Process(function () use ($n, $config, $key) {
        $obj = RedisLock::getInstance(new RedisSetting($config));
        $isLock = $obj->lock($key, 2);
        if ($isLock) {
            echo $n . ' 进程抢占到锁';
            echo PHP_EOL;
        }
    });
    $process->start();
}
for ($n = 5; --$n;) {
    $status = Process::wait(true);
    echo "Recycled #{$status['pid']}, code={$status['code']}, signal={$status['signal']}" . PHP_EOL;
}
