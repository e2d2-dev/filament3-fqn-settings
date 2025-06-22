<?php

namespace Betta\Filament\FqnSettings\Values\Concerns;

use Filament\Schemas\Components\Tabs\Tab;

trait AsTab
{
    public function tab(): Tab
    {
        return Tab::make($this->getHeading() ?? str(static::class)->classBasename()->toString())
            ->icon($this->getIcon())
            ->schema($this->schema());
    }

    public function modifyTabUsing(Tab $tab): Tab
    {
        return $tab;
    }

    public function asTab(): Tab
    {
        return $this->modifyTabUsing($this->tab());
    }
}
