<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Sections;

use Betta\Settings\Models\FqnSetting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;

class ValueSection extends Section
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->heading(__('filament-fqn-settings::field.Value'));

        $this->description(function (?FqnSetting $record) {
            if(! $record) {
                return null;
            }
            $class = $record->fqn;

            return class_exists($class) ?
                __('filament-fqn-settings::state.Cached').': '.$class::get() :
                __('filament-fqn-settings::state.MarkedLost');
        });

        $this->icon('heroicon-o-arrow-up-tray');

        $this->schema([
            TextInput::make('value')
                ->hiddenLabel()
                ->live()
                ->hidden(fn ($get) => $get('type') == 'bool')
                // ->string(fn($get) => $get('type') == 'string')
                ->integer(fn ($get) => $get('type') == 'integer')
                ->required(),
        ]);
    }
}
