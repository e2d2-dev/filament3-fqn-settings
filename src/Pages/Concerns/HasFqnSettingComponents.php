<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Betta\Filament\FqnSettings\Values\SettingSchema;
use Betta\Settings\SettingAttribute;
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

    protected function getComponentData(): array
    {
        $data = [];

        /** @var SettingAttribute $component */
        foreach ($this->initializedSettingComponents as $component) {
            $data = array_merge($data, Arr::undot($component->getValues()));
        }

        return $data;
    }

    public function getSchemaComponents(): array
    {
        return collect($this->initializedSettingComponents)->map(function (SettingSchema $component) {

            return $component->getComponents();

        })->flatten()->toArray();
    }
}
