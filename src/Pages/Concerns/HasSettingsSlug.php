<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

trait HasSettingsSlug
{
    public static function getSlug(): string
    {
        return 'settings/'.parent::getSlug();
    }
}
