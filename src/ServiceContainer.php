<?php

namespace Framework;

use Exception;

class ServiceContainer
{
    /** @var array<class-string, object> */
    private array $instances = [];

    /**
     * @template T of object
     * @param class-string<T> $id
     * @param object $instance
     * @throws Exception
     */
    public function set(string $id, object $instance): void
    {
        if (isset($this->instances[$id])) {
            throw new Exception("Target binding [$id] already exists.");
        }
        $this->instances[$id] = $instance;
    }

    /**
     * @template T of object
     * @param class-string<T> $id
     * @return T
     * @throws Exception
     */
    public function get(string $id): object
    {
        if (!isset($this->instances[$id])) {
            throw new Exception("Target binding [$id] does not exist.");
        }
        /** @var T */
        return $this->instances[$id];
    }
}
