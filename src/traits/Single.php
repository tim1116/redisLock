<?php

/*
 * This file is part of the redisLock package.
 *
 * Author:Tim Xiao
 */

namespace tim1116\redisLock\traits;

trait Single
{
    private static $instance = null;

    /**
     * prevent the instance from being cloned (which would create a second instance of it).
     */
    private function __clone()
    {
    }

    /**
     * 防止通过反序列化生成类实例.
     *
     * $obj1 = Singleton::getInstance();
     * $obj2= unserialize(serialize($obj1));
     */
    private function __wakeup()
    {
    }

    /**
     * 初始化.
     *
     * @param mixed ...$args
     *
     * @return static
     */
    public static function getInstance(...$args)
    {
        if (is_null(static::$instance)) {
            static::$instance = new static(...$args);
        }

        return static::$instance;
    }
}
