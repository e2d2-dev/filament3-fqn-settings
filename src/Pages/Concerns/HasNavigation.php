<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

trait HasNavigation
{
    use HasBreadcrumb;

    public static string $titleFromClassname;

    public static function getNavigationLabel(): string
    {
        return static::getTitleFromClassname();
    }

    public function getHeading(): string
    {
        return static::getTitleFromClassname();
    }

    public static function getTitleFromClassname(): string
    {
        return str(static::class)->classBasename()->remove('Settings')->remove('Setup');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-fqn-settings::model.Settings');
    }
}
