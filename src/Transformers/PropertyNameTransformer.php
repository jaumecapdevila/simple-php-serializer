<?php

namespace SimpleSerializer\Transformers;


interface PropertyNameTransformer
{
    public function transform(string $key): string;
}