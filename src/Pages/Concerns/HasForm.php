<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

trait HasForm
{
    protected function getForms(): array
    {
        $this->registerComponents();

        return [
            'form' =>
                $this->makeForm()
                    ->schema([
                        ...$this->beforeSchema(),
                        ...$this->getSchemaComponents(),
                        ...$this->afterSchema(),
                    ])
                    ->operation('edit')
                    ->statePath($this->getFormStatePath())
                    ->columns($this->hasInlineLabels() ? 1 : 2)
                    ->inlineLabel($this->hasInlineLabels()),

        ];
    }

    public function getFormStatePath(): ?string
    {
        return 'data';
    }
}
