<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Sections;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class DefaultValueSection extends Section
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->heading(__('filament-fqn-settings::field.DefaultValue'));

        $this->description(__('filament-fqn-settings::description.DefaultValue'));

        $this->icon('heroicon-o-light-bulb');

        $this->schema([
            TextInput::make('default')
                ->disabledOn('edit')
                ->hiddenLabel()
                ->live()
                ->hidden(fn ($get) => $get('type') == 'bool')
                // ->string(fn($get) => $get('type') == 'string')
                ->integer(fn ($get) => $get('type') == 'integer')
                ->required(),
        ]);
    }
}
