<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Actions;

use Betta\Settings\Models\FqnSetting;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;

class RecoverFileAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'recoverFile';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('filament-fqn-settings::action.Recover'));

        $this->link();

        $this->icon('heroicon-o-document-arrow-down');

        $this->requiresConfirmation();

        $this->visible(fn (?FqnSetting $record) => $record && app()->environment('local') && $record->isLost());

        $this->successNotificationTitle(__('filament-fqn-settings::notification.ClassFileWasCreated'));

        $this->modalDescription(fn() => $this->isInAppNameSpace() ?
            __('filament-fqn-settings::description.CreatePhpFile') :
            __('filament-fqn-settings::description.OutsideAppNamespace')
        );

        $this->modalSubmitAction(fn() => $this->isInAppNameSpace() ?
            parent::getModalSubmitAction() :
            false
        );

        $this->action(function (FqnSetting $record, $action) {
            $record->createClassFile();
            $record->resetLost();
            $action->success();
        });
    }

    public function isInAppNameSpace(): bool
    {
        return str($this->getRecord()->fqn)->startsWith('App\\');
    }
}
