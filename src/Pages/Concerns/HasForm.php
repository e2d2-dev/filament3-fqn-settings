<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Betta\Filament\FqnSettings\Enums\SchemaAs;

trait HasForm
{
    protected function getForms(): array
    {
        $this->registerComponents();

        return [
            'form' => $this->makeForm()
                ->schema([
                    ...$this->beforeSchema(),
                    ...$this->asTabs(),
                    ...$this->getSchemaComponents(),
                    ...$this->afterSchema(),
                ])
                ->operation('edit')
                ->statePath($this->getFormStatePath())
                ->columns(),
        ];
    }

    public function getFormStatePath(): ?string
    {
        return 'data';
    }
}
