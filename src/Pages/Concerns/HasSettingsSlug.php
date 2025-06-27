<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

trait HasSettingsSlug
{
    public static function getSlug(): string
    {
        $str = str(parent::getSlug());

        if ($str->contains('-setup')) {
            return $str->remove('-setup')->prepend('setup/');
        }
        if ($str->endsWith('-settings')) {
            return $str->remove('-settings')->prepend('settings/');
        }

        return $str->prepend('settings/');
    }
}
