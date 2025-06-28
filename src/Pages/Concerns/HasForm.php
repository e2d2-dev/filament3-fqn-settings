<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

trait HasForm
{
    protected function getForms(): array
    {
        $this->registerComponents();

        return [
            'form' => $this->makeForm()
                ->schema([
                    ...$this->beforeSchema(),
                    //...$this->asTabs(),
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
