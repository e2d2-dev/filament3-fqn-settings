<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use UnitEnum;

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
        return str(static::class)->classBasename()->remove('Settings');
    }

    public static function getNavigationGroup(): string|null
    {
        return __('filament-fqn-settings::model.Settings');
    }
}
