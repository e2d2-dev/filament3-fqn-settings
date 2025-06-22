<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Sections;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;

class EncryptSection extends Section
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->heading(__('filament-fqn-settings::field.Encryption'));

        $this->description(__('filament-fqn-settings::description.EncryptedValue'));

        $this->icon('heroicon-o-finger-print');

        $this->schema([
            Toggle::make('encrypt')
                ->onIcon('heroicon-o-check')
                ->onColor('success')
                ->label(__('filament-fqn-settings::state.Activated')),
        ]);
    }
}
