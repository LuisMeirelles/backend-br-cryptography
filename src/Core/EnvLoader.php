<?php

namespace Meirelles\BackendBrCriptografia\Core;

use Meirelles\BackendBrCriptografia\Env;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionProperty;

class EnvLoader
{
    /**
     * @throws \Meirelles\BackendBrCriptografia\Core\AppException
     */
    public function __construct()
    {
        self::init();
    }

    /**
     * @return void
     * @throws \Meirelles\BackendBrCriptografia\Core\AppException
     */
    public static function init(): void
    {
        self::validateVars();
    }

    /**
     * @return void
     * @throws \Meirelles\BackendBrCriptografia\Core\AppException
     */
    private static function validateVars(): void
    {
        $environment = Env::getInstance();

        $reflectionClass = new ReflectionClass($environment);
        $reflectionProperties = $reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach ($reflectionProperties as $reflectionProperty) {
            /** @var ReflectionAttribute<EnvValidator>[] $reflectionAttributes */
            $reflectionAttributes = $reflectionProperty->getAttributes(EnvValidator::class, ReflectionAttribute::IS_INSTANCEOF);

            foreach ($reflectionAttributes as $reflectionAttribute) {
                $attribute = $reflectionAttribute->newInstance();
                $variableName = preg_replace('/([A-Z])/', '_$1', $reflectionProperty->getName());
                $variableName = mb_convert_case($variableName, MB_CASE_UPPER);

                $value = getenv($variableName);

                if ($value !== false) {
                    $attribute->value = $value;
                }

                $attribute->name = $reflectionProperty->getName();

                $attribute->validate();

                self::castType($value, $reflectionProperty, $environment);
            }
        }
    }

    /**
     * @throws \Meirelles\BackendBrCriptografia\Core\AppException
     */
    private static function castType(string $value, ReflectionProperty $reflectionProperty, Env $environment): void
    {
        $type = $reflectionProperty->getType();

        switch ($type) {
            case 'int':
                $reflectionProperty->setValue($environment, (int)$value);
                break;
            case 'bool':
                $reflectionProperty->setValue($environment, (bool)$value);
                break;
            case 'float':
                $reflectionProperty->setValue($environment, (float)$value);
                break;
            case 'string':
                $reflectionProperty->setValue($environment, $value);
                break;
            default:
                throw new AppException('Type not supported');
        }
    }
}