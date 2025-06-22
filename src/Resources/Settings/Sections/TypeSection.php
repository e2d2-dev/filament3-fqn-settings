<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Sections;

use Betta\Filament\FqnSettings\Resources\Settings\Schemas\Fields\TypeSelect;
use Filament\Forms\Components\Section;

class TypeSection extends Section
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->heading(__('filament-fqn-settings::field.ReturnType'));

        $this->icon('heroicon-o-arrow-left');

        $this->schema([
            TypeSelect::make('type')->hiddenLabel(),
        ]);
    }
}
