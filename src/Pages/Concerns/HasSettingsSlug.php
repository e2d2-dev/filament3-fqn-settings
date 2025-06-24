<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Filament\Panel;

trait HasSettingsSlug
{
    public static function getSlug(?Panel $panel = null): string
    {
        return 'settings/'.parent::getSlug($panel);
    }
}
