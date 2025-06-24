<?php

namespace Betta\Filament\FqnSettings\Values\Concerns\Return;

use Filament\Forms\Components\Section;

trait AsSection
{
    public function section(): Section
    {
        return Section::make()
            ->columnSpan($this->columnSpan())
            ->columns($this->columns())
            ->heading($this->getHeading())
            ->description($this->getDescription())
            ->icon($this->getIcon())
            ->iconColor($this->getIconColor())
            ->schema($this->schema());
    }

    public function modifySectionUsing(Section $section): Section
    {
        return $section;
    }

    public function asSection(): Section
    {
        return $this->modifySectionUsing($this->section());
    }
}
