<?php

namespace Betta\Filament\FqnSettings\Providers;

use Betta\Filament\FqnSettings\Commands\CreatePageCommand;
use Betta\Filament\FqnSettings\Commands\CreateSchemaCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentFqnSettingsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-fqn-settings');

        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'filament-fqn-settings');

        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'filament-fqn-settings');
    }

    protected function bootPackageCommands(): self
    {
        $this->commands([
            CreatePageCommand::class,
            CreateSchemaCommand::class,
        ]);

        return $this;
    }
}
