<?php

namespace Betta\Filament\FqnSettings\Resources\Concerns;

trait HasPrefixedBreadcrumb
{
    public function getBreadcrumbs(): array
    {
        return [
            __('filament-fqn-settings::model.Settings'),
            ...parent::getBreadcrumbs(),
        ];
    }
}
