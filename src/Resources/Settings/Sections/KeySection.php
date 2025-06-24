<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Sections;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class KeySection extends Section
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->heading(__('filament-fqn-settings::field.Key'));

        $this->icon('heroicon-o-key');

        $this->hiddenOn('edit');

        $this->schema([
            TextInput::make('key')
                ->hiddenLabel()
                ->disabledOn('edit')
                ->reactive()
                ->dehydrateStateUsing(fn ($state, $set) => $set('key', str($state)->snake()))
                ->required(),
        ]);
    }
}
