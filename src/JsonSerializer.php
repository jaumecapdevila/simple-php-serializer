<?php

namespace SimpleSerializer;


use Nette\Reflection\ClassType;
use SimpleSerializer\Naming\CamelCaseStrategy;
use SimpleSerializer\Naming\NamingStrategy;
use SimpleSerializer\Naming\SnakeCaseStrategy;

class JsonSerializer implements Serializer
{
    /** @var  NamingStrategy */
    private $namingStrategy;

    /**
     * JsonSerializer constructor.
     * @param NamingStrategy $namingStrategy
     */
    public function __construct(NamingStrategy $namingStrategy)
    {
        $this->namingStrategy = $namingStrategy;
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
            $reflection = new ClassType(get_class($rawData));
            if (!$reflection->isUserDefined()) {
                throw new \LogicException(sprintf('Class "%s" is not user-defined', $reflection->getName()));
            }
            if ($reflection->hasAnnotation('Naming\\Strategy')) {
                $this->resolveNamingStrategy($reflection->getAnnotation('Naming\\Strategy'));
            }
            foreach ($reflection->getProperties() as $property) {
                $property->setAccessible(true);
                $data[$this->namingStrategy->convert($property->getName())] = $this->extractSerializableDataFrom($property->getValue($rawData));
            }
            return $data;
        }
        if (is_array($rawData)) {
            $data = [];
            foreach ($rawData as $key => $element) {
                $data[$this->namingStrategy->convert($key)] = $this->extractSerializableDataFrom($element);
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

    /**
     * Change the current property name namingStrategy based on the annotations found in the current object
     * @param string $namingStrategy
     * @internal param PropertyNameTransformer $namingStrategy
     */
    private function resolveNamingStrategy(string $namingStrategy)
    {
        switch ($namingStrategy) {
            case 'SnakeCase':
                $namingStrategy = new SnakeCaseStrategy();
                break;
            default:
                $namingStrategy = new CamelCaseStrategy();
        }
        $this->namingStrategy = $namingStrategy;
    }
}