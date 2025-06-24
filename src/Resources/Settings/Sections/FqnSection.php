<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Sections;

use Betta\Filament\FqnSettings\Resources\Settings\Schemas\Fields\FqnField;
use Filament\Schemas\Components\Section;

class FqnSection extends Section
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->description(__('filament-fqn-settings::field.FqnFull'));

        $this->heading('FQN');

        $this->visibleOn('edit');

        $this->icon('heroicon-o-academic-cap');

        $this->schema([
            FqnField::make('fqn'),
        ]);
    }
}
