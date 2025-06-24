<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Sections;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;

class KeySection extends Section
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->heading(__('filament-fqn-settings::field.Key'));

        $this->icon('heroicon-o-key');

        $this->hiddenOn('edit');

        $this->columnSpan(1);

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
