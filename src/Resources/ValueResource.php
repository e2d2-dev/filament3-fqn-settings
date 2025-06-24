<?php

namespace Betta\Filament\FqnSettings\Resources;

use Betta\Filament\FqnSettings\Pages\Concerns\HasSettingsSlug;
use Betta\Filament\FqnSettings\Resources\Settings\Pages\CreateValue;
use Betta\Filament\FqnSettings\Resources\Settings\Pages\EditValue;
use Betta\Filament\FqnSettings\Resources\Settings\Pages\ListValues;
use Betta\Filament\FqnSettings\Resources\Settings\Schemas\ValueForm;
use Betta\Filament\FqnSettings\Resources\Settings\Tables\ValuesTable;
use Betta\Settings\Models\FqnSetting;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class ValueResource extends Resource
{
    use HasSettingsSlug;

    protected static ?string $model = FqnSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    public static function form(Form $form): Form
    {
        return ValueForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return ValuesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListValues::route('/'),
            'create' => CreateValue::route('/create'),
            'edit' => EditValue::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('filament-fqn-settings::model.Value');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-fqn-settings::model.Values');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-fqn-settings::model.Values');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-fqn-settings::model.Settings');
    }
}
