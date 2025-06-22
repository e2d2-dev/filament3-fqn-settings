<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Pages;

use Betta\Filament\FqnSettings\Resources\Concerns\HasPrefixedBreadcrumb;
use Betta\Filament\FqnSettings\Resources\Settings\Actions\CacheSettingAction;
use Betta\Filament\FqnSettings\Resources\Settings\Actions\CacheSettingResetAction;
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
            CacheSettingResetAction::make(),
            CacheSettingAction::make(),
            RecoverFileAction::make(),
            DeleteAction::make()
                ->requiresConfirmation()
                ->modalDescription(__('filament-fqn-settings::description.DatabaseDelete')),
        ];
    }
}
