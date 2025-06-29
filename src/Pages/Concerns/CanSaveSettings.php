<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use App\Settings\Aaa;
use Betta\Settings\SettingAttribute;
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
        $this->form->validate();

        $content = $this->fetchValues($this->form->getState());

        $content = $this->mutateSaveDataUsing($content);

        try {
            collect(Arr::dot($content))->each(function ($value, string $statepath) {
                $fqnEnd = str($statepath)
                    ->afterLast('.')
                    ->studly();

                $fqn = str($statepath)
                    ->beforeLast('.')
                    ->title()
                    ->replace('__', '\\')
                    ->replace('_', '')
                    ->append('\\')
                    ->append($fqnEnd)
                    ->toString();

                /** @var SettingAttribute $fqn */
                $fqn::set($value);
            });

            $this->success();

        } catch (\Exception $exception) {
            $this->failure($exception->getMessage());
        }
    }

    protected function fetchValues(array $data): array
    {
        $return = [];

        foreach ($data as $path => $attributes) {
            foreach ($attributes as $fqnEnd => $v) {
                $return[$path][$fqnEnd] = is_array($v) ? json_encode($v) : $v;
            }
        }
        return $return;
    }
}
