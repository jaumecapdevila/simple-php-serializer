<?php

namespace SimpleSerializer\Transformers;


class SnakeCaseTransformer implements PropertyNameTransformer
{
    /**
     * @param string $key
     * @return string
     */
    public function transform(string $key): string
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