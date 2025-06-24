<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Filament\Actions\Action;

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
        $content = $this->content->validate();
        $content = $this->mutateSaveDataUsing($content);

        try {
            collect($content['data'])->mapWithKeys(function ($value, $namespace) {
                $key = str(array_key_first($value))->studly();

                $namespace = str($namespace)
                    ->title()
                    ->replace('_', '\\')
                    ->append('\\')
                    ->append($key)
                    ->toString();

                $value = $value[array_key_first($value)];

                return [$namespace => $value];
            })->each(function ($value, $fqn) {
                $fqn::set($value);
            });

            $this->success();

        } catch (\Exception $exception) {
            $this->failure($exception->getMessage());
        }
    }
}
