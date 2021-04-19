<?php


namespace src\Decorator;


class CacheDecorator
{

    private static array $list = [];
    private array $registry;

    public static function getInstance(string $instance = 'default')
    {
        if (!isset(self::$list[$instance])) self::$list[$instance] = new self;
        return self::$list[$instance];
    }

    private function __construct()
    {
    }
    private function __clone()
    {
    }
    private function __wakeup()
    {
    }

    /**
     * @param string $key
     * @param $val
     */

    public function set(string $key, $val): void
    {
        $key = md5($key);
        $this->registry[$key] = $val;
    }

    /**
     * @param string $key
     * @return array
     */

    public function get(string $key): array
    {
        $key = md5($key);
        if (isset($this->registry[$key]))
            return $this->registry[$key];
        else
            return [];
    }
}