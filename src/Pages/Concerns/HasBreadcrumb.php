<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

trait HasBreadcrumb
{
    public function getBreadcrumbs(): array
    {
        return [
            __('filament-fqn-settings::model.Settings'),
            static::getTitleFromClassname(),
        ];
    }
}
