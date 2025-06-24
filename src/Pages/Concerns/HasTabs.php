<?php

namespace Betta\Filament\FqnSettings\Pages\Concerns;

use Filament\Forms\Components\Tabs;

trait HasTabs
{
    public function getTabs(string $label): Tabs
    {
        return Tabs::make($label);
    }
}
