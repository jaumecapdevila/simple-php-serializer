<?php

namespace SimpleSerializer\Naming;


interface NamingStrategy
{
    public function convert(string $key): string;
}