<?php

namespace SimpleSerializer\Transformers;


class CamelCaseTransformer implements PropertyNameTransformer
{
    /**
     * @param string $key
     * @return string
     */
    public function transform(string $key): string
    {
        return $this->fromSnakeCase($key);
    }

    /**
     * @param $key
     * @return string
     */
    private function fromSnakeCase($key): string
    {
        $filteredKey = str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
        $filteredKey[0] = strtolower($filteredKey[0]);
        return $filteredKey;
    }
}