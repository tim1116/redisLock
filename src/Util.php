<?php


declare(strict_types=1);

namespace tim1116\redisLock;

class Util
{
    // 获取lockkey
    public static function lockKey(string $key): string
    {
        return $key;
    }
}
