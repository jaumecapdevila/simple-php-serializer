<?php

namespace SimpleSerializer;


use SimpleSerializer\Transformers\PropertyNameTransformer;

class JsonSerializer implements Serializer
{
    /** @var  PropertyNameTransformer */
    private $transformer;

    /**
     * JsonSerializer constructor.
     * @param PropertyNameTransformer $transformer
     */
    public function __construct(PropertyNameTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function serialize($rawData)
    {
        return json_encode($this->extractSerializableDataFrom($rawData), JSON_PRETTY_PRINT);
    }

    public function deserialize()
    {
        // TODO: Implement deserialize() method.
    }

    private function extractSerializableDataFrom($rawData)
    {
        if (is_object($rawData)) {
            $data = [];
            $reflection = new \ReflectionClass(get_class($rawData));
            if (!$reflection->isUserDefined()) {
                throw new \LogicException(sprintf('Class "%s" is not user-defined', $reflection->getName()));
            }
            foreach ($reflection->getProperties() as $property) {
                $property->setAccessible(true);
                $data[$this->transformer->transform($property->getName())] = $this->extractSerializableDataFrom($property->getValue($rawData));
            }
            return $data;
        }
        if (is_array($rawData)) {
            $data = [];
            foreach ($rawData as $key => $element) {
                $data[$this->transformer->transform($key)] = $this->extractSerializableDataFrom($element);
            }
            return $data;
        }
        if (is_scalar($rawData) || $rawData === null) {
            return $rawData;
        }
        throw new \LogicException(sprintf(
            'Unsupported type: "%s" (%s). You can only serialize objects, arrays and scalar values.',
            gettype($rawData),
            var_export($rawData, true)
        ));
    }
}