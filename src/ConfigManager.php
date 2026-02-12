<?php

namespace Framework;

class ConfigManager
{
    /**
     * @var string[]
     */
    public array $config;

    /**
     * @param string[] $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function get(string $key): string
    {
        if (!isset($this->config[$key])) {
            throw new \Exception("Config key not found");
        }
        return $this->config[$key];
    }
}
