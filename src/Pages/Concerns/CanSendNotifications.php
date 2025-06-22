<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Filament\Notifications\Notification;

trait CanSendNotifications
{
    public function failure(?string $message): void
    {
        $this->getFailureNotification()->body($message)->send();
    }

    public function success(): void
    {
        $this->getSuccessNotification()->send();
    }

    public function getSuccessNotificationTitle(): string
    {
        return __('filament-fqn-settings::model.Settings').' '.lcfirst(__('filament-fqn-settings::state.Saved'));
    }

    public function getFailureNotification(): Notification
    {
        return Notification::make('failure')
            ->title(__('filament-fqn-settings::state.Error'))
            ->danger();
    }

    public function getSuccessNotification(): Notification
    {
        return Notification::make('success')
            ->title($this->getSuccessNotificationTitle())
            ->success();
    }
}
