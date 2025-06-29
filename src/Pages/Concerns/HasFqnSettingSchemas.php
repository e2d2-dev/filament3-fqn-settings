<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Betta\Filament\FqnSettings\Values\SettingSchema;
use Filament\Forms\Components\Tabs;
use Illuminate\Support\Arr;

trait HasFqnSettingSchemas
{
    protected array $initializedSettingSchemas = [];

    protected function registerComponents(): void
    {
        foreach ($this->schemas as $component) {
            if (class_exists($component)) {
                $instance = app($component);
                $this->initializedSettingSchemas[$component] = $instance;
            }
        }
    }

    public function getComponentData(): array
    {
        $data = [];

        foreach ($this->initializedSettingSchemas as $component) {
            /** @var SettingSchema $component */
            $data = array_merge($data, $component->getValues());
        }

        return Arr::undot($data);
    }

    public function getSchemaComponents(): array
    {
        return collect($this->initializedSettingSchemas)->map(function (SettingSchema $component) {

            return $component->getComponents();

        })->flatten()->toArray();
    }

    public function asTabs(array $components = []): array
    {
        return [
            Tabs::make()
                ->columnSpanFull()
                ->schema($components),
        ];
    }
}
