<?php

namespace Betta\Filament\FqnSettings\Resources\Settings\Sections;

use Betta\Filament\FqnSettings\Resources\Settings\Forms\Actions\CacheSettingResetFormAction;
use Betta\Settings\Models\FqnSetting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
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

            $matched = match($record->type){
                'bool' => $value ? 'true' : 'false',
                'array' => 'array',
                default => $value,
            };

            return __('filament-fqn-settings::state.Cached').': '.$matched;
        });

        $this->columnSpan(1);

        $this->icon(config('filament-fqn-settings.icon.Value'));

        $this->schema([
            TextInput::make('value')
                // ->hiddenLabel()
                ->live()
                ->hidden(fn ($get) => match ($get('type')){
                    'bool' => true,
                    'array' => true,
                    default => false,
                })
                // ->string(fn($get) => $get('type') == 'string')
                ->integer(fn ($get) => $get('type') == 'integer')
                ->required(),

            Textarea::make('hidden_array')
                ->hiddenLabel()
                ->visible(fn ($get) => $get('type') == 'array'),

            Toggle::make('hidden_value')
                ->visible(fn ($get) => $get('type') == 'bool')
                ->hiddenLabel(),
        ]);
    }
}
