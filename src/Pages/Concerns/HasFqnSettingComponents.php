<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Betta\Filament\FqnSettings\Enums\SchemaAs;
use Betta\Filament\FqnSettings\Values\SettingSchema;
use Betta\Settings\SettingAttribute;
use Filament\Forms\Components\Tabs;
use Illuminate\Support\Arr;

trait HasFqnSettingComponents
{
    protected array $initializedSettingComponents = [];

    protected function registerComponents(): void
    {
        foreach ($this->settingComponents as $component) {
            if (class_exists($component)) {
                $instance = app($component);
                $this->initializedSettingComponents[$component] = $instance;
            }
        }
    }

    public function getComponentData(): array
    {
        $data = [];

        /** @var SettingAttribute $component */
        foreach ($this->initializedSettingComponents as $component) {
            $data = array_merge($data, $component->getValues());
        }

        return Arr::undot($data);
    }

    public function getSchemaComponents(): array
    {
        return collect($this->initializedSettingComponents)->map(function (SettingSchema $component) {

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
