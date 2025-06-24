<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Filament\Actions\Action;
use Illuminate\Support\Arr;

trait CanSaveSettings
{
    use CanSendNotifications;

    public function getCachedFormActions(): array
    {
        return [
            $this->formSaveAction(),
        ];
    }

    public function formSaveAction()
    {
        return Action::make('save')
            ->label(__('filament-fqn-settings::action.Save'))
            ->keyBindings(['mod+s'])
            ->action('save');
    }

    public function mutateSaveDataUsing(array $data): array
    {
        return $data;
    }

    public function save(): void
    {
        $content = $this->form->validate();
        $content = $this->mutateSaveDataUsing($content);

        try {
            collect(Arr::dot($content['data']))->each(function ($value, string $statepath) {
                $fqnEnd = str($statepath)
                    ->afterLast('.')
                    ->studly();

                $fqn = str($statepath)
                    ->beforeLast('.')
                    ->title()
                    ->replace('_', '\\')
                    ->append('\\')
                    ->append($fqnEnd)
                    ->toString();

                $fqn::set($value);
            });

            $this->success();

        } catch (\Exception $exception) {
            $this->failure($exception->getMessage());
        }
    }
}
