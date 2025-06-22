<?php

namespace Betta\Filament\FqnSettings;

use Betta\Filament\FqnSettings\Resources\ValueResource;
use Filament\Contracts\Plugin;
use Filament\Panel;

class FqnSettingsPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'fqn-settings';
    }

    public function register(Panel $panel): void
    {
        $panel->resources([
            ValueResource::class,
        ]);

        $panel->discoverPages(in: app_path('Filament/Settings/Pages'), for: 'App\Filament\Settings\Pages');
    }

    public function boot(Panel $panel): void {}
}
