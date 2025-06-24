<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Sections;

use Betta\Filament\FqnSettings\Resources\Settings\Schemas\Fields\TypeSelect;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;

class TypeSection extends Section
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->heading(__('filament-fqn-settings::field.ReturnType'));

        $this->columnSpan(1);

        $this->columns(3);

        $this->icon('heroicon-o-arrow-left');

        $this->schema([
            TypeSelect::make('type')
                ->columnSpan(2)
                ->hiddenLabel(),

            Toggle::make('nullable')
                ->columnSpan(1)
                ->disabled('edit')
                ->label(__('filament-fqn-settings::field.Nullable')),
        ]);
    }
}
