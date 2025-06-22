<?php

namespace Betta\Filament\FqnSettings\Commands\FileGenerators;

use Betta\Filament\FqnSettings\Values\SettingSchema;
use Betta\Settings\Commands\Filegenerators\ClassGenerator;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Literal;
use Nette\PhpGenerator\Method;

class SettingSchemaClassGenerator extends ClassGenerator
{
    final public function __construct(
        protected string $fqn,
        protected string $name,
    ) {}

    public function getNamespace(): string
    {
        return $this->extractNamespace($this->getFqn());
    }

    public function getExtends(): ?string
    {
        return SettingSchema::class;
    }

    public function getImports(): array
    {
        return [
            SettingSchema::class
        ];
    }

    protected function addMethodsToClass(ClassType $class): void
    {
        $class->addMethod('schema')
            ->setPublic()
            ->setReturnType('array')
            ->setBody($this->addSchemaMethod());

    }

    public function addSchemaMethod(): string
    {
        return new Literal(
            <<<PHP
                return [
                    //
                ];
                PHP
        );
    }


    protected function addPropertiesToClass(ClassType $class): void
    {
        $class->addProperty('fqnSettings')
            ->setValue([])
            ->setProtected()
            ->setType('array');
    }

    public function getBasename(): string
    {
        return class_basename($this->getFqn());
    }


    public function getFqn(): string
    {
        return $this->fqn;
    }
}
