<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Illuminate\Support\Arr;
use Values\DemoSetting;

trait HasFqnSettingComponents
{
    protected array $initializedSettingComponents = [];

    protected function registerComponents(): void
    {
        foreach ($this->settingComponents as $component) {
            if(class_exists($component)){
                $instance = app($component);
                $this->initializedSettingComponents[$component] = $instance;
            }
        }
    }

    protected function getComponentData(): array
    {
        $data = [];
        /** @var DemoSetting $component */
        foreach ($this->initializedSettingComponents as $component) {
            $data = array_merge($data, Arr::undot($component->getValues()));
        }

        return $data;
    }

    public function getSchemaComponents(): array
    {
        return collect($this->initializedSettingComponents)->map(function ($component) {

            return $component->getComponents();

        })->flatten()->toArray();
    }
}
