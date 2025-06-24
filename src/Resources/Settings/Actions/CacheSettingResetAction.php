<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Actions;

use Filament\Actions\Action;

class CacheSettingResetAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'resetSettingCache';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-fqn-settings::field.Cache'));

        $this->link();

        $this->color('danger');

        $this->icon('heroicon-o-trash');

        $this->tooltip(fn (\Betta\Settings\Models\FqnSetting $record) => when(! $record->isCached(), 'Key is not cached'));

        $this->successNotificationTitle(__('filament-fqn-settings::notification.KeyRemovedFromCache'));

        $this->visible(fn (\Betta\Settings\Models\FqnSetting $record) => $record->isCached());

        $this->action(function (\Betta\Settings\Models\FqnSetting $record, $action) {
            $record->forgetCache();
            $action->success();
        });
    }
}
