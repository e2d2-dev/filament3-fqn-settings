<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Filament\Actions\Action;

trait HasFormActions
{
    protected function getSaveFormAction(): Action
    {
        $hasFormWrapper = $this->hasFormWrapper();

        return Action::make('save')
            ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
            ->submit($hasFormWrapper ? $this->getSubmitFormLivewireMethodName() : null)
            ->action($hasFormWrapper ? null : $this->getSubmitFormLivewireMethodName())
            ->keyBindings(['mod+s']);
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
        ];
    }

    public function hasFormWrapper(): bool
    {
        return false;
    }

    public function hasFullWidthFormActions(): bool
    {
        return false;
    }

    protected function getSubmitFormLivewireMethodName(): string
    {
        return 'save';
    }
}
