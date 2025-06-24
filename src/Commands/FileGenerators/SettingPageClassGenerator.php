<?php

namespace Betta\Filament\FqnSettings\Commands\FileGenerators;

use Betta\Filament\FqnSettings\Pages\SettingPage;
use Betta\Settings\Commands\Filegenerators\ClassGenerator;
use Nette\PhpGenerator\ClassType;

class SettingPageClassGenerator extends ClassGenerator
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
        return SettingPage::class;
    }

    /**
     * @return array<string>
     */
    public function getImports(): array
    {
        return [
            SettingPage::class,
        ];
    }

    protected function addPropertiesToClass(ClassType $class): void
    {
        $class->addProperty('settingComponents')
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
