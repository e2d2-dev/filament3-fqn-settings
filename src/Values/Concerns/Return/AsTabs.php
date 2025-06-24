<?php

namespace Betta\Filament\FqnSettings\Values\Concerns\Return;

use Betta\Filament\FqnSettings\Pages\Concerns\HasTabs;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use ReflectionClass;

trait AsTabs
{
    use HasTabs;

    public function tabs(): Tabs
    {
        return Tabs::make()
            ->schema($this->getTabSchemas());
    }

    public function getTabSchemas(): array
    {
        $reflection = new ReflectionClass($this);

        return collect($reflection->getMethods())
            ->filter(function (\ReflectionMethod $method) {
                return str($method->getName())->endsWith('Tab') && $method->getReturnType() == Tab::class;
            })
            ->map(function (\ReflectionMethod $method) {
                return $method->getName();
            })
            ->map(function (string $name) {
                return $this->{$name}(
                    Tab::make(
                        str($name)->remove('Tab')->title()
                    )
                );
            })->flatten()->toArray();
    }
}
