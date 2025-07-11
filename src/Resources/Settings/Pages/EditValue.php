<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Pages;

use Betta\Filament\FqnSettings\Resources\Concerns\HasPrefixedBreadcrumb;
use Betta\Filament\FqnSettings\Resources\Settings\Actions\CacheSettingAction;
use Betta\Filament\FqnSettings\Resources\Settings\Actions\RecoverFileAction;
use Betta\Filament\FqnSettings\Resources\ValueResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditValue extends EditRecord
{
    use HasPrefixedBreadcrumb;

    protected static string $resource = ValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CacheSettingAction::make(),
            RecoverFileAction::make(),
            DeleteAction::make()
                ->requiresConfirmation()
                ->modalDescription(__('filament-fqn-settings::description.DatabaseDelete')),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if ($data['type'] == 'bool') {
            $data['hidden_value'] = $data['value'];
        }
        if ($data['type'] == 'array') {
            $data['hidden_array'] = $data['value'];
        }
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data = $this->saveJsonWhenArray($data);
        return $this->saveBoolWhenSelected($data);
    }

    protected function saveJsonWhenArray(array $data): array
    {
        if ($data['type'] == 'array') {
            $data['value'] = $data['hidden_array'];
            unset($data['hidden_array']);
        }

        return $data;
    }

    protected function saveBoolWhenSelected(array $data): array
    {
        if ($data['type'] == 'bool') {
            $data['value'] = (bool) $data['hidden_value'];
            unset($data['hidden_value']);
            $data['encrypt'] = false;
        }

        return $data;
    }
}
