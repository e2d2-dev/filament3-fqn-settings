<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Actions;

use Filament\Actions\Action;

class CacheSettingAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'cacheSetting';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Cache');

        $this->icon('heroicon-o-arrow-path');

        $this->tooltip(fn (\Betta\Settings\Models\FqnSetting $record) => when(! $record->isCached(), 'Cache Setting'));

        $this->successNotificationTitle(__('filament-fqn-settings::notification.SettingCached'));

        $this->visible(fn (\Betta\Settings\Models\FqnSetting $record) => ! $record->isCached());
        $this->action(function (\Betta\Settings\Models\FqnSetting $record, $action) {
            $record->cache();
            $action->success();
        });
    }
}
