<?php

namespace SimpleSerializer;


interface Serializer
{
    public function serialize($rawData);

    public function deserialize();
}