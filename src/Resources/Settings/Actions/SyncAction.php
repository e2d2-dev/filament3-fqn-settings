<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Actions;

use Betta\Settings\Settings;
use Filament\Actions\Action;
use Filament\Support\Colors\Color;

class SyncAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'sync';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-fqn-settings::action.Sync'));

        $this->icon('heroicon-o-magnifying-glass');

        $this->color(Color::Indigo);

        $this->link();

        $this->requiresConfirmation();

        $this->modalDescription(__('filament-fqn-settings::description.SyncDatabase'));

        $this->action(function () {
            $log = Settings::sync();

            $this->successNotificationTitle($log->getMessage());

            $this->success();
        });
    }
}
