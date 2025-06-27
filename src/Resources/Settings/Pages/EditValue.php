<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Pages;

use Betta\Filament\FqnSettings\Resources\Concerns\HasPrefixedBreadcrumb;
use Betta\Filament\FqnSettings\Resources\Settings\Actions\CacheSettingAction;
use Betta\Filament\FqnSettings\Resources\Settings\Actions\CacheSettingResetAction;
use Betta\Filament\FqnSettings\Resources\Settings\Actions\RecoverFileAction;
use Betta\Filament\FqnSettings\Resources\ValueResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Crypt;

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
        if ($data['encrypt']) {
            $data['value'] = Crypt::decrypt($data['value']);
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $this->saveBoolWhenSelected($data);
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
