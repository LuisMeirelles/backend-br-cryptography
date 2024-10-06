<?php

namespace Meirelles\BackendBrCryptography\Core;

use JsonSerializable;
use ReflectionClass;
use ReflectionProperty;
use Symfony\Component\String\Inflector\EnglishInflector;
use Symfony\Component\String\UnicodeString;

class Model implements JsonSerializable
{
    protected readonly string $tableName;
    protected readonly array $properties;

    public function __construct()
    {
        $reflection = new ReflectionClass($this);
        $className = $reflection->getShortName();

        $snakeCaseName = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $className));

        $inflector = new EnglishInflector();
        $pluralized = $inflector->pluralize($snakeCaseName)[0];

        $this->tableName = $pluralized;

        $propertiesReflections = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);

        $properties = [];

        foreach ($propertiesReflections as $propertyReflection) {
            if (!$propertyReflection->isInitialized($this)) {
                continue;
            }

            $name = $propertyReflection->getName();
            $value = $propertyReflection->getValue($this);

            $properties[$name] = $value;
        }

        $this->properties = $properties;
    }

    public function save(): void
    {
        $properties = $this->toArray();

        $propertyNames = array_keys($properties);
        $columnNames = array_map(fn($name) => (new UnicodeString($name))->snake()->toString(), $propertyNames);
        $columnNames = implode(', ', $columnNames);

        $columnValuePlaceholders = array_map(fn(string $key) => ":$key", array_keys($properties));
        $columnValuePlaceholders = implode(', ', $columnValuePlaceholders);

        $updateColumns = array_map(function (string $key) {
            $columnName = (new UnicodeString($key))
                ->snake()
                ->toString();

            return "$columnName = VALUES($columnName)";
        }, array_keys($properties));

        $updateColumns = implode(", ", $updateColumns);

        $sql = "INSERT INTO $this->tableName ($columnNames)
                VALUES ($columnValuePlaceholders)
                ON DUPLICATE KEY UPDATE $updateColumns";

        Database::execWithParams($sql, $properties);
    }

    public function toArray(): array
    {
        return $this->properties;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}