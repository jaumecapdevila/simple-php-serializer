<?php

namespace SimpleSerializer\Naming;


class SnakeCaseStrategy implements NamingStrategy
{
    /**
     * @param string $key
     * @return string
     */
    public function convert(string $key): string
    {
        return $this->fromCamelCaseKey($key);
    }

    /**
     * @param $key
     * @return string
     */
    private function fromCamelCaseKey($key): string
    {
        return strtolower(
            preg_replace(
                '/(?<=[a-z])(?=[A-Z])/',
                "_",
                $key
            )
        );
    }
}