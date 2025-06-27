<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Sections;

use Betta\Filament\FqnSettings\Resources\Settings\Forms\Actions\CacheSettingResetFormAction;
use Betta\Settings\Models\FqnSetting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class ValueSection extends Section
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->heading(__('filament-fqn-settings::field.Value'));

        $this->headerActions([
            CacheSettingResetFormAction::make(),
        ]);

        $this->description(function (?FqnSetting $record) {
            if (! $record) {
                return null;
            }

            $class = $record->fqn;

            if (! class_exists($class)) {
                return __('filament-fqn-settings::state.MarkedLost');
            }

            $value = $class::get();

            if ($record->type == 'bool') {
                $value = $value ? 'true' : 'false';
            }

            return __('filament-fqn-settings::state.Cached').': '.$value;
        });

        $this->columnSpan(1);

        $this->icon(config('filament-fqn-settings.icon.Value'));

        $this->schema([
            TextInput::make('value')
                ->hiddenLabel()
                ->live()
                ->hidden(fn ($get) => $get('type') == 'bool')
                // ->string(fn($get) => $get('type') == 'string')
                ->integer(fn ($get) => $get('type') == 'integer')
                ->required(),

            Toggle::make('hidden_value')
                ->visible(fn ($get) => $get('type') == 'bool')
                ->hiddenLabel(),
        ]);
    }
}
