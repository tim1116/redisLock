<?php

declare(strict_types=1);

/*
 * This file is part of the redisLock package.
 *
 * Author:Tim Xiao
 */

namespace tim1116\redisLock;

class Util
{
    // 获取lockkey
    public static function lockKey(string $key): string
    {
        return $key;
    }
}
