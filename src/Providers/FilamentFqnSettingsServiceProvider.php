<?php

namespace Betta\Filament\FqnSettings\Providers;

use Betta\Filament\FqnSettings\Commands\CreatePageCommand;
use Betta\Filament\FqnSettings\Commands\CreateSchemaCommand;
use Illuminate\Support\ServiceProvider;

class FilamentFqnSettingsServiceProvider extends ServiceProvider
{
    protected function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/filament-fqn-settings.php', 'filament-fqn-settings');

        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'filament-fqn-settings');

        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'filament-fqn-settings');

        $this->commands([
            CreatePageCommand::class,
            CreateSchemaCommand::class,
        ]);
    }
}
